<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Handler;

use BnplPartners\Factoring004\ChangeStatus\AbstractMerchantOrder;
use BnplPartners\Factoring004\ChangeStatus\DeliveryOrder;
use BnplPartners\Factoring004\ChangeStatus\DeliveryStatus;
use BnplPartners\Factoring004\Otp\SendOtp;

class DeliveryHandler extends AbstractOrderStatusHandler
{
    private const KEY = 'delivery';

    protected function sendOtp(string $orderId, int $totalAmount): void
    {
        $this->createApi()
            ->otp
            ->sendOtp(new SendOtp($this->getMerchantId(), $orderId, $totalAmount));
    }

    protected function createChangeStatusOrder(string $orderId, int $totalAmount): AbstractMerchantOrder
    {
        return new DeliveryOrder($orderId, DeliveryStatus::DELIVERED(), $totalAmount);
    }

    public function shouldProcess($orderStatusId): bool
    {
        return $orderStatusId === '5';
    }

    public function getKey(): string
    {
        return static::KEY;
    }
}
