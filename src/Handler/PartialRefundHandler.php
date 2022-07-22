<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Handler;

use BnplPartners\Factoring004\ChangeStatus\ReturnStatus;

class PartialRefundHandler extends AbstractOrderStatusRefundHandler
{
    private const KEY = 'partial_refund';

    protected function createReturnStatus(): ReturnStatus
    {
        return ReturnStatus::PARTRETURN();
    }

    public function shouldProcess($orderStatusId): bool
    {
        return (string) $orderStatusId === static::KEY;
    }

    public function getKey(): string
    {
        return static::KEY;
    }
}
