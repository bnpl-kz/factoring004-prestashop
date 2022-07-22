<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Handler;

use BnplPartners\Factoring004\ChangeStatus\AbstractMerchantOrder;
use BnplPartners\Factoring004\ChangeStatus\ReturnOrder;
use BnplPartners\Factoring004\ChangeStatus\ReturnStatus;
use BnplPartners\Factoring004\Otp\SendOtpReturn;

abstract class AbstractOrderStatusRefundHandler extends AbstractOrderStatusHandler
{
    abstract protected function createReturnStatus(): ReturnStatus;

    protected function sendOtp(string $orderId, int $totalAmount): void
    {
        $this->createApi()
            ->otp
            ->sendOtpReturn(new SendOtpReturn($totalAmount, $this->getMerchantId(), $orderId));
    }

    protected function createChangeStatusOrder(string $orderId, int $totalAmount): AbstractMerchantOrder
    {
        return new ReturnOrder($orderId, $this->createReturnStatus(), $totalAmount);
    }
}
