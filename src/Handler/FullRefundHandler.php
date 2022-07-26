<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Handler;

use BnplPartners\Factoring004\ChangeStatus\ReturnStatus;
use ConfigurationCore;

class FullRefundHandler extends AbstractOrderStatusRefundHandler
{
    private const KEY = 'full_refund';

    protected function createReturnStatus(): ReturnStatus
    {
        return ReturnStatus::RETURN();
    }

    public function shouldProcess($orderStatusId): bool
    {
        return $orderStatusId === ConfigurationCore::get('FACTORING004_RETURN_ORDER_STATUS');
    }

    public function getKey(): string
    {
        return static::KEY;
    }
}
