<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop;

use BnplPartners\Factoring004\Api;
use BnplPartners\Factoring004\Auth\BearerTokenAuth;
use BnplPartners\Factoring004\ChangeStatus\DeliveryOrder;
use BnplPartners\Factoring004\ChangeStatus\DeliveryStatus;
use BnplPartners\Factoring004\ChangeStatus\MerchantsOrders;
use BnplPartners\Factoring004\Exception\ErrorResponseException;
use BnplPartners\Factoring004\Otp\SendOtp;
use BnplPartners\Factoring004\Response\ErrorResponse;
use BnplPartners\Factoring004\Transport\TransportInterface;
use ConfigurationCore;
use OrderCore;

class DeliveryHandler
{
    /**
     * @var \BnplPartners\Factoring004\Transport\TransportInterface
     */
    private $transport;

    public function __construct(TransportInterface $transport)
    {
        $this->transport = $transport;
    }

    /**
     * @param int|string $orderStatusId
     *
     * @throws \BnplPartners\Factoring004\Exception\PackageException
     */
    public function handle(int $orderId, $orderStatusId): bool
    {
        $order = new OrderCore($orderId);

        if ($orderStatusId !== '5') {
            return false;
        }
        
        if (in_array((string) $order->id_carrier, $this->getConfirmableDeliveryMethods(), true)) {
            $this->sendOtp((string) $orderId, (int) ceil($order->total_paid));
            return true;
        }

        $this->confirmWithoutOtp((string) $orderId, (int) ceil($order->total_paid));
        return false;
    }

    /**
     * @throws \BnplPartners\Factoring004\Exception\PackageException
     */
    private function sendOtp(string $orderId, int $totalAmount): void
    {
        $this->createApi()
            ->otp
            ->sendOtp(new SendOtp($this->getMerchantId(), $orderId, $totalAmount));
    }

    /**
     * @throws \BnplPartners\Factoring004\Exception\PackageException
     */
    private function confirmWithoutOtp(string $orderId, int $totalAmount): void
    {
        $response = $this->createApi()
            ->changeStatus
            ->changeStatusJson([
                new MerchantsOrders($this->getMerchantId(), [
                    new DeliveryOrder($orderId, DeliveryStatus::DELIVERED(), $totalAmount),
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

    private function createApi(): Api
    {
        return Api::create(
            ConfigurationCore::get('FACTORING004_API_HOST') ?: 'http://localhost',
            new BearerTokenAuth(ConfigurationCore::get('FACTORING004_AS_TOKEN') ?: ''),
            $this->transport
        );
    }

    private function getMerchantId(): string
    {
        return ConfigurationCore::get('FACTORING004_PARTNER_CODE') ?: '';
    }

    /**
     * @return string[]
     */
    private function getConfirmableDeliveryMethods(): array
    {
        return array_map('trim', explode(',', ConfigurationCore::get('FACTORING004_DELIVERY_METHODS') ?: ''));
    }
}
