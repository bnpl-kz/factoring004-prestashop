<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Otp;

interface OtpCheckerInterface
{
    /**
     * @throws \BnplPartners\Factoring004\Exception\PackageException
     */
    public function check(string $orderId, int $amount, string $otp): void;
}
