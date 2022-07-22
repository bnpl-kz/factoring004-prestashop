<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Otp;

use BnplPartners\Factoring004\Api;
use BnplPartners\Factoring004\Auth\BearerTokenAuth;
use BnplPartners\Factoring004\Otp\CheckOtpReturn;
use BnplPartners\Factoring004\Transport\TransportInterface;
use ConfigurationCore;

class RefundOtpChecker implements OtpCheckerInterface
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
     * @throws \BnplPartners\Factoring004\Exception\PackageException
     */
    public function check(string $orderId, int $amount, string $otp): void
    {
        $this->createApi()->otp->checkOtpReturn(new CheckOtpReturn($amount, $this->getMerchantId(), $orderId, $otp));
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
}
