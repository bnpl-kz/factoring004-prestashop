<?php

declare(strict_types=1);

use BnplPartners\Factoring004\Signature\PostLinkSignatureValidator;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @mixin \FrontControllerCore
 */
class Factoring004PostLinkModuleFrontController extends ModuleFrontControllerCore
{
    private const REQUIRED_FIELDS = ['status', 'billNumber', 'preappId'];
    private const STATUS_PREAPPROVED = 'preapproved';
    private const STATUS_COMPLETED = 'completed';
    private const STATUS_DECLINED = 'declined';
    private const RESPONSE_COMPLETED = 'ok';

    public $guestAllowed = true;
    protected $json = true;

    public function postProcess(): void
    {
        try {
            $request = $this->readJsonInput();
            $this->validateRequest($request);
        } catch (Exception $e) {
            $this->jsonResponse(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
            return;
        }

        $order = new OrderCore($request['billNumber']);

        if ($order->getOrdersTotalPaid() === null) {
            $this->jsonResponse(['error' => 'Order not found'], JsonResponse::HTTP_BAD_REQUEST);
            return;
        }

        if ($request['status'] === static::STATUS_PREAPPROVED) {
            $this->jsonResponse(['response' => static::STATUS_PREAPPROVED]);
            return;
        }

        $orderHistory = new OrderHistoryCore();
        $orderHistory->id_order = $order->id;

        if ($request['status'] === static::STATUS_COMPLETED) {
            DB::getInstance()->execute('BEGIN');

            $orderHistory->changeIdOrderState(2, $order->id);
            DB::getInstance()->insert('factoring004_order_preapps', [
                'order_id' => $order->id,
                'preapp_uid' => $request['preappId'],
            ]);

            if (DB::getInstance()->execute('COMMIT')) {
                $this->jsonResponse(['response' => static::RESPONSE_COMPLETED]);
                return;
            }

            $this->jsonResponse(['error' => 'Unable to update order status'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            return;
        }

        if ($request['status'] === static::STATUS_DECLINED) {
            $orderHistory->changeIdOrderState(8, $order->id);
            $this->jsonResponse(['response' => static::STATUS_DECLINED]);
            return;
        }

        $this->jsonResponse(['error' => 'Unsupported status given'], JsonResponse::HTTP_BAD_REQUEST);
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
        PostLinkSignatureValidator::create('secret')->validateData($request);
    }

    /**
     * @param array<string, mixed> $data
     * @param array<string, string> $headers
     */
    private function jsonResponse(array $data, int $status = JsonResponse::HTTP_OK, array $headers = []): void
    {
        $response = new JsonResponse($data, $status, $headers);
        $response->send();
    }
}
