<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Helper;

use BnplPartners\Factoring004\OAuth\CacheOAuthTokenManager;
use BnplPartners\Factoring004\OAuth\OAuthTokenManager;
use BnplPartners\Factoring004\Transport\TransportInterface;
use Cache;
use ConfigurationCore;
use Psr\SimpleCache\CacheInterface;

class AuthTokenManager
{
    protected $manager;

    public function __construct(string $login, string $password, string $apiHost, TransportInterface $transport, CacheInterface $cache)
    {
        $tokenManager = new OAuthTokenManager($apiHost . '/users/api/v1', $login, $password, $transport);
        $this->manager = new CacheOAuthTokenManager($tokenManager, $cache, 'bnpl.payment');
    }

    public static function init(TransportInterface $transport): AuthTokenManager
    {
        $authLogin = ConfigurationCore::get('FACTORING004_OAUTH_LOGIN') ?: '';
        $authPassword = ConfigurationCore::get('FACTORING004_OAUTH_PASSWORD') ?: '';
        $apiHost = ConfigurationCore::get('FACTORING004_API_HOST') ?: '';
        $cache = new CacheAdapter(Cache::getInstance());

        return new self($authLogin, $authPassword, $apiHost, $transport, $cache);
    }

    public function getToken(): string
    {
        return $this->manager->getAccessToken()->getAccess();
    }
}