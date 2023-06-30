<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Handler;

use BnplPartners\Factoring004\Api;
use BnplPartners\Factoring004\Auth\BearerTokenAuth;
use BnplPartners\Factoring004\ChangeStatus\CancelOrder;
use BnplPartners\Factoring004\ChangeStatus\CancelStatus;
use BnplPartners\Factoring004\ChangeStatus\MerchantsOrders;
use BnplPartners\Factoring004\Exception\ErrorResponseException;
use BnplPartners\Factoring004\Response\ErrorResponse;
use BnplPartners\Factoring004\Transport\TransportInterface;
use BnplPartners\Factoring004Prestashop\Helper\AuthTokenManager;
use ConfigurationCore;
use OrderCore;

class CancelHandler implements OrderStatusHandlerInterface
{
    /**
     * @var \BnplPartners\Factoring004\Transport\TransportInterface
     */
    protected $transport;

    public function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    public function getKey(): string
    {
        return 'cancel';
    }

    public function shouldProcess($orderStatusId): bool
    {
        return (string) $orderStatusId === ConfigurationCore::get('FACTORING004_CANCEL_ORDER_STATUS');
    }

    public function handle(OrderCore $order, $amount = null): bool
    {
        $response = $this->createApi()
            ->changeStatus
            ->changeStatusJson([
                new MerchantsOrders($this->getMerchantId(), [
                    new CancelOrder((string) $order->id, CancelStatus::CANCEL()),
                ]),
            ]);

        foreach ($response->getErrorResponses() as $errorResponse) {
            throw new ErrorResponseException(new ErrorResponse(
                $errorResponse->getCode(),
                $errorResponse->getMessage(),
                null,
                null,
                $errorResponse->getError()
            ));
        }

        return false;
    }

    protected function createApi(): Api
    {
        return Api::create(
            ConfigurationCore::get('FACTORING004_API_HOST') ?: 'http://localhost',
            new BearerTokenAuth(AuthTokenManager::init($this->transport)->getToken()),
            $this->transport
        );
    }

    protected function getMerchantId(): string
    {
        return ConfigurationCore::get('FACTORING004_PARTNER_CODE') ?: '';
    }
}
