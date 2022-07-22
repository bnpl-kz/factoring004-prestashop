<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Handler;

use OrderCore;

interface OrderStatusHandlerInterface
{
    public function getKey(): string;

    /**
     * @param int|string $orderStatusId
     */
    public function shouldProcess($orderStatusId): bool;

    /**
     * @param int|float|null $amount Leave amount is null to get amount from order.
     *
     * @return bool if true OTP to be checked
     *
     * @throws \BnplPartners\Factoring004\Exception\PackageException
     */
    public function handle(OrderCore $order, $amount = null): bool;
}
