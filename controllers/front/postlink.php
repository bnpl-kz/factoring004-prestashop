<?php

declare(strict_types=1);

use BnplPartners\Factoring004\Signature\PostLinkSignatureValidator;
use PrestaShop\PrestaShop\Core\Domain\Order\Command\UpdateOrderStatusCommand;
use PrestaShop\PrestaShop\Core\Domain\Order\CommandHandler\UpdateOrderStatusHandlerInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\JsonResponse;

class Factoring004PostLinkModuleFrontController extends ModuleFrontControllerCore implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    private const REQUIRED_FIELDS = ['status', 'billNumber', 'preappId'];
    private const STATUS_PREAPPROVED = 'preapproved';
    private const STATUS_COMPLETED = 'completed';
    private const STATUS_DECLINED = 'declined';
    private const RESPONSE_COMPLETED = 'ok';

    public $guestAllowed = true;
    protected $json = true;

    /**
     * @var \PrestaShop\PrestaShop\Core\Domain\Order\CommandHandler\UpdateOrderStatusHandlerInterface
     */
    private $updateStatusHandler;

    public function setUpdateStatusHandler(UpdateOrderStatusHandlerInterface $updateStatusHandler): void
    {
        $this->updateStatusHandler = $updateStatusHandler;
    }

    public function postProcess(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->jsonResponse(['error' => 'Invalid request method'], JsonResponse::HTTP_METHOD_NOT_ALLOWED, ['Allow' => 'POST']);
            return;
        }

        try {
            $request = $this->readJsonInput();

            $this->logger->debug('Factoring004 POSTLINK: ' . json_encode($request));
            $this->validateRequest($request);
        } catch (Exception $e) {
            $this->jsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
            return;
        }

        if ((new OrderCore($request['billNumber']))->module !== 'factoring004') {
            $this->jsonResponse(['error' => 'Order payment is not factoring004'], JsonResponse::HTTP_BAD_REQUEST);
            return;
        }

        if ($request['status'] === static::STATUS_PREAPPROVED) {
            $this->jsonResponse(['response' => static::STATUS_PREAPPROVED]);
            return;
        }

        if ($request['status'] === static::STATUS_COMPLETED) {

            $status = (int) ConfigurationCore::get('FACTORING004_PAID_ORDER_STATUS');
            $this->setFactoring004OrderStatus($request['billNumber'], $status);

            $this->jsonResponse(['response' => static::RESPONSE_COMPLETED]);
            return;
        }

        if ($request['status'] === static::STATUS_DECLINED) {
            $status = (int) ConfigurationCore::get('FACTORING004_DECLINED_ORDER_STATUS');

            $this->setFactoring004OrderStatus($request['billNumber'], $status);

            $this->jsonResponse(['response' => static::STATUS_DECLINED]);
            return;
        }

        $this->jsonResponse(['error' => 'Unsupported status given'], JsonResponse::HTTP_BAD_REQUEST);
    }

    private function setFactoring004OrderStatus($orderId, $statusId)
    {
        try {
            $history = new OrderHistory();
            $history->id_order = $orderId;
            $history->changeIdOrderState($statusId, (int) $orderId);
            $history->addWithemail();
            $history->save();
        } catch (Exception $e) {
            $this->logger->debug('Factoring004 Order status update error: ' . $e->getMessage());
        }
    }

    /**
     * @return array<string, mixed>
     */
    private function readJsonInput(): array
    {
        $request = json_decode(file_get_contents('php://input'), true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $request;
        }

        throw new UnexpectedValueException('Invalid JSON input');
    }

    /**
     * @param array<string, mixed> $request
     *
     * @throws \BnplPartners\Factoring004\Exception\InvalidSignatureException
     */
    private function validateRequest(array $request): void
    {
        foreach (static::REQUIRED_FIELDS as $field) {
            if (empty($request[$field]) || !is_string($request[$field])) {
                throw new InvalidArgumentException('The field ' . $field . ' is required and must be a string');
            }
        }

        $this->validateSignature($request);
    }

    /**
     * @param array<string, mixed> $request
     *
     * @throws \BnplPartners\Factoring004\Exception\InvalidSignatureException
     */
    private function validateSignature(array $request): void
    {
        PostLinkSignatureValidator::create(ConfigurationCore::get('FACTORING004_PARTNER_CODE'))->validateData($request);
    }

    /**
     * @param array<string, mixed> $data
     * @param array<string, string> $headers
     */
    private function jsonResponse(array $data, int $status = JsonResponse::HTTP_OK, array $headers = []): void
    {
        $response = new JsonResponse($data, $status, $headers);
        $response->sendHeaders();

        $this->ajaxRender($response->getContent());
        exit;
    }
}
