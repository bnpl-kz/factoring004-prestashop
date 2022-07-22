<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Handler;

use BnplPartners\Factoring004\ChangeStatus\ReturnStatus;

class FullRefundHandler extends AbstractOrderStatusRefundHandler
{
    private const KEY = 'full_refund';

    protected function createReturnStatus(): ReturnStatus
    {
        return ReturnStatus::RETURN();
    }

    public function shouldProcess($orderStatusId): bool
    {
        return $orderStatusId === '7';
    }

    public function getKey(): string
    {
        return static::KEY;
    }
}
