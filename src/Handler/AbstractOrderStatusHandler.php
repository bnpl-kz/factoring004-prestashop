<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Handler;

use BnplPartners\Factoring004\Api;
use BnplPartners\Factoring004\Auth\BearerTokenAuth;
use BnplPartners\Factoring004\ChangeStatus\AbstractMerchantOrder;
use BnplPartners\Factoring004\ChangeStatus\MerchantsOrders;
use BnplPartners\Factoring004\Exception\ErrorResponseException;
use BnplPartners\Factoring004\Response\ErrorResponse;
use BnplPartners\Factoring004\Transport\TransportInterface;
use BnplPartners\Factoring004Prestashop\Helper\AuthTokenManager;
use ConfigurationCore;
use OrderCore;

abstract class AbstractOrderStatusHandler implements OrderStatusHandlerInterface
{
    /**
     * @var \BnplPartners\Factoring004\Transport\TransportInterface
     */
    protected $transport;

    public function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    final public function handle(OrderCore $order, $amount = null): bool
    {
        if (in_array((string) $order->id_carrier, $this->getConfirmableDeliveryMethods(), true)) {
            $this->sendOtp((string) $order->id, (int) ceil($amount ?? $order->total_paid));
            return true;
        }

        $this->confirmWithoutOtp((string) $order->id, (int) ceil($amount ?? $order->total_paid));
        return false;
    }

    /**
     * @throws \BnplPartners\Factoring004\Exception\PackageException
     */
    abstract protected function sendOtp(string $orderId, int $totalAmount): void;

    abstract protected function createChangeStatusOrder(string $orderId, int $totalAmount): AbstractMerchantOrder;

    /**
     * @throws \BnplPartners\Factoring004\Exception\PackageException
     */
    protected function confirmWithoutOtp(string $orderId, int $totalAmount): void
    {
        $response = $this->createApi()
            ->changeStatus
            ->changeStatusJson([
                new MerchantsOrders($this->getMerchantId(), [
                    $this->createChangeStatusOrder($orderId, $totalAmount),
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
    }

    protected function createApi(): Api
    {
        return Api::create(
            ConfigurationCore::get('FACTORING004_API_HOST') ?: 'http://localhost',
            new BearerTokenAuth($this->getAuthToken()),
            $this->transport
        );
    }

    protected function getAuthToken(): string
    {
        return AuthTokenManager::init($this->transport)->getToken();
    }

    protected function getMerchantId(): string
    {
        return ConfigurationCore::get('FACTORING004_PARTNER_CODE') ?: '';
    }

    /**
     * @return string[]
     */
    protected function getConfirmableDeliveryMethods(): array
    {
        $ids = ConfigurationCore::get('FACTORING004_DELIVERY_METHODS');

        return $ids ? array_map('trim', explode(',', $ids)) : [];
    }
}
