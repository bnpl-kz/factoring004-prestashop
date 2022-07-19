<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbe2252d99514ef070c626c30540e0d4c
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'e69f7f6ee287b969198c3c9d6777bd38' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/bootstrap.php',
        '25072dd6e2470089de65ae7bf11d3109' => __DIR__ . '/..' . '/symfony/polyfill-php72/bootstrap.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        'f598d06aa772fa33d905e87be6398fb1' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/bootstrap.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php72\\' => 23,
            'Symfony\\Polyfill\\Intl\\Normalizer\\' => 33,
            'Symfony\\Polyfill\\Intl\\Idn\\' => 26,
        ),
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
        ),
        'M' => 
        array (
            'MyCLabs\\Enum\\' => 13,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
        'B' => 
        array (
            'BnplPartners\\Factoring004\\' => 26,
            'BnplPartners\\Factoring004Prestashop\\' => 36,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php72\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php72',
        ),
        'Symfony\\Polyfill\\Intl\\Normalizer\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer',
        ),
        'Symfony\\Polyfill\\Intl\\Idn\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-intl-idn',
        ),
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'MyCLabs\\Enum\\' => 
        array (
            0 => __DIR__ . '/..' . '/myclabs/php-enum/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'BnplPartners\\Factoring004\\' => 
        array (
            0 => __DIR__ . '/..' . '/bnpl-partners/factoring004/src',
        ),
        'BnplPartners\\Factoring004Prestashop\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'W' => 
        array (
            'Wa72\\SimpleLogger' => 
            array (
                0 => __DIR__ . '/..' . '/wa72/simplelogger',
            ),
        ),
    );

    public static $classMap = array (
        'BnplPartners\\Factoring004\\AbstractResource' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/AbstractResource.php',
        'BnplPartners\\Factoring004\\Api' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Api.php',
        'BnplPartners\\Factoring004\\ArrayInterface' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ArrayInterface.php',
        'BnplPartners\\Factoring004\\Auth\\ApiKeyAuth' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Auth/ApiKeyAuth.php',
        'BnplPartners\\Factoring004\\Auth\\AuthenticationInterface' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Auth/AuthenticationInterface.php',
        'BnplPartners\\Factoring004\\Auth\\BasicAuth' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Auth/BasicAuth.php',
        'BnplPartners\\Factoring004\\Auth\\BearerTokenAuth' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Auth/BearerTokenAuth.php',
        'BnplPartners\\Factoring004\\Auth\\NoAuth' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Auth/NoAuth.php',
        'BnplPartners\\Factoring004\\ChangeStatus\\AbstractMerchantOrder' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ChangeStatus/AbstractMerchantOrder.php',
        'BnplPartners\\Factoring004\\ChangeStatus\\CancelOrder' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ChangeStatus/CancelOrder.php',
        'BnplPartners\\Factoring004\\ChangeStatus\\CancelStatus' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ChangeStatus/CancelStatus.php',
        'BnplPartners\\Factoring004\\ChangeStatus\\ChangeStatusResource' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ChangeStatus/ChangeStatusResource.php',
        'BnplPartners\\Factoring004\\ChangeStatus\\ChangeStatusResponse' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ChangeStatus/ChangeStatusResponse.php',
        'BnplPartners\\Factoring004\\ChangeStatus\\DeliveryOrder' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ChangeStatus/DeliveryOrder.php',
        'BnplPartners\\Factoring004\\ChangeStatus\\DeliveryStatus' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ChangeStatus/DeliveryStatus.php',
        'BnplPartners\\Factoring004\\ChangeStatus\\ErrorResponse' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ChangeStatus/ErrorResponse.php',
        'BnplPartners\\Factoring004\\ChangeStatus\\MerchantsOrders' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ChangeStatus/MerchantsOrders.php',
        'BnplPartners\\Factoring004\\ChangeStatus\\ReturnOrder' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ChangeStatus/ReturnOrder.php',
        'BnplPartners\\Factoring004\\ChangeStatus\\ReturnStatus' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ChangeStatus/ReturnStatus.php',
        'BnplPartners\\Factoring004\\ChangeStatus\\SuccessResponse' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/ChangeStatus/SuccessResponse.php',
        'BnplPartners\\Factoring004\\Exception\\ApiException' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Exception/ApiException.php',
        'BnplPartners\\Factoring004\\Exception\\AuthenticationException' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Exception/AuthenticationException.php',
        'BnplPartners\\Factoring004\\Exception\\DataSerializationException' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Exception/DataSerializationException.php',
        'BnplPartners\\Factoring004\\Exception\\EndpointUnavailableException' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Exception/EndpointUnavailableException.php',
        'BnplPartners\\Factoring004\\Exception\\ErrorResponseException' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Exception/ErrorResponseException.php',
        'BnplPartners\\Factoring004\\Exception\\InvalidSignatureException' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Exception/InvalidSignatureException.php',
        'BnplPartners\\Factoring004\\Exception\\NetworkException' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Exception/NetworkException.php',
        'BnplPartners\\Factoring004\\Exception\\OAuthException' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Exception/OAuthException.php',
        'BnplPartners\\Factoring004\\Exception\\PackageException' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Exception/PackageException.php',
        'BnplPartners\\Factoring004\\Exception\\TransportException' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Exception/TransportException.php',
        'BnplPartners\\Factoring004\\Exception\\UnexpectedResponseException' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Exception/UnexpectedResponseException.php',
        'BnplPartners\\Factoring004\\Exception\\ValidationException' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Exception/ValidationException.php',
        'BnplPartners\\Factoring004\\OAuth\\CacheOAuthTokenManager' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/OAuth/CacheOAuthTokenManager.php',
        'BnplPartners\\Factoring004\\OAuth\\OAuthToken' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/OAuth/OAuthToken.php',
        'BnplPartners\\Factoring004\\OAuth\\OAuthTokenManager' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/OAuth/OAuthTokenManager.php',
        'BnplPartners\\Factoring004\\OAuth\\OAuthTokenManagerInterface' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/OAuth/OAuthTokenManagerInterface.php',
        'BnplPartners\\Factoring004\\Otp\\CheckOtp' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Otp/CheckOtp.php',
        'BnplPartners\\Factoring004\\Otp\\CheckOtpReturn' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Otp/CheckOtpReturn.php',
        'BnplPartners\\Factoring004\\Otp\\DtoOtp' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Otp/DtoOtp.php',
        'BnplPartners\\Factoring004\\Otp\\OtpResource' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Otp/OtpResource.php',
        'BnplPartners\\Factoring004\\Otp\\SendOtp' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Otp/SendOtp.php',
        'BnplPartners\\Factoring004\\Otp\\SendOtpReturn' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Otp/SendOtpReturn.php',
        'BnplPartners\\Factoring004\\PreApp\\DeliveryPoint' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/PreApp/DeliveryPoint.php',
        'BnplPartners\\Factoring004\\PreApp\\Item' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/PreApp/Item.php',
        'BnplPartners\\Factoring004\\PreApp\\PartnerData' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/PreApp/PartnerData.php',
        'BnplPartners\\Factoring004\\PreApp\\PreAppMessage' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/PreApp/PreAppMessage.php',
        'BnplPartners\\Factoring004\\PreApp\\PreAppResource' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/PreApp/PreAppResource.php',
        'BnplPartners\\Factoring004\\PreApp\\Status' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/PreApp/Status.php',
        'BnplPartners\\Factoring004\\PreApp\\ValidationErrorDetail' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/PreApp/ValidationErrorDetail.php',
        'BnplPartners\\Factoring004\\Response\\ErrorResponse' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Response/ErrorResponse.php',
        'BnplPartners\\Factoring004\\Response\\PreAppResponse' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Response/PreAppResponse.php',
        'BnplPartners\\Factoring004\\Response\\ValidationErrorResponse' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Response/ValidationErrorResponse.php',
        'BnplPartners\\Factoring004\\Signature\\PostLinkSignatureCalculator' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Signature/PostLinkSignatureCalculator.php',
        'BnplPartners\\Factoring004\\Signature\\PostLinkSignatureValidator' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Signature/PostLinkSignatureValidator.php',
        'BnplPartners\\Factoring004\\Transport\\AbstractTransport' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Transport/AbstractTransport.php',
        'BnplPartners\\Factoring004\\Transport\\GuzzleTransport' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Transport/GuzzleTransport.php',
        'BnplPartners\\Factoring004\\Transport\\PsrTransport' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Transport/PsrTransport.php',
        'BnplPartners\\Factoring004\\Transport\\Response' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Transport/Response.php',
        'BnplPartners\\Factoring004\\Transport\\ResponseInterface' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Transport/ResponseInterface.php',
        'BnplPartners\\Factoring004\\Transport\\TransportInterface' => __DIR__ . '/..' . '/bnpl-partners/factoring004/src/Transport/TransportInterface.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'GuzzleHttp\\Client' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Client.php',
        'GuzzleHttp\\ClientInterface' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/ClientInterface.php',
        'GuzzleHttp\\Cookie\\CookieJar' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/CookieJar.php',
        'GuzzleHttp\\Cookie\\CookieJarInterface' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/CookieJarInterface.php',
        'GuzzleHttp\\Cookie\\FileCookieJar' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/FileCookieJar.php',
        'GuzzleHttp\\Cookie\\SessionCookieJar' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/SessionCookieJar.php',
        'GuzzleHttp\\Cookie\\SetCookie' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Cookie/SetCookie.php',
        'GuzzleHttp\\Exception\\BadResponseException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/BadResponseException.php',
        'GuzzleHttp\\Exception\\ClientException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/ClientException.php',
        'GuzzleHttp\\Exception\\ConnectException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/ConnectException.php',
        'GuzzleHttp\\Exception\\GuzzleException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/GuzzleException.php',
        'GuzzleHttp\\Exception\\InvalidArgumentException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/InvalidArgumentException.php',
        'GuzzleHttp\\Exception\\RequestException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/RequestException.php',
        'GuzzleHttp\\Exception\\SeekException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/SeekException.php',
        'GuzzleHttp\\Exception\\ServerException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/ServerException.php',
        'GuzzleHttp\\Exception\\TooManyRedirectsException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/TooManyRedirectsException.php',
        'GuzzleHttp\\Exception\\TransferException' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Exception/TransferException.php',
        'GuzzleHttp\\HandlerStack' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/HandlerStack.php',
        'GuzzleHttp\\Handler\\CurlFactory' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/CurlFactory.php',
        'GuzzleHttp\\Handler\\CurlFactoryInterface' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/CurlFactoryInterface.php',
        'GuzzleHttp\\Handler\\CurlHandler' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/CurlHandler.php',
        'GuzzleHttp\\Handler\\CurlMultiHandler' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/CurlMultiHandler.php',
        'GuzzleHttp\\Handler\\EasyHandle' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/EasyHandle.php',
        'GuzzleHttp\\Handler\\MockHandler' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/MockHandler.php',
        'GuzzleHttp\\Handler\\Proxy' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/Proxy.php',
        'GuzzleHttp\\Handler\\StreamHandler' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Handler/StreamHandler.php',
        'GuzzleHttp\\MessageFormatter' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/MessageFormatter.php',
        'GuzzleHttp\\Middleware' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Middleware.php',
        'GuzzleHttp\\Pool' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Pool.php',
        'GuzzleHttp\\PrepareBodyMiddleware' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/PrepareBodyMiddleware.php',
        'GuzzleHttp\\Promise\\AggregateException' => __DIR__ . '/..' . '/guzzlehttp/promises/src/AggregateException.php',
        'GuzzleHttp\\Promise\\CancellationException' => __DIR__ . '/..' . '/guzzlehttp/promises/src/CancellationException.php',
        'GuzzleHttp\\Promise\\Coroutine' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Coroutine.php',
        'GuzzleHttp\\Promise\\Create' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Create.php',
        'GuzzleHttp\\Promise\\Each' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Each.php',
        'GuzzleHttp\\Promise\\EachPromise' => __DIR__ . '/..' . '/guzzlehttp/promises/src/EachPromise.php',
        'GuzzleHttp\\Promise\\FulfilledPromise' => __DIR__ . '/..' . '/guzzlehttp/promises/src/FulfilledPromise.php',
        'GuzzleHttp\\Promise\\Is' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Is.php',
        'GuzzleHttp\\Promise\\Promise' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Promise.php',
        'GuzzleHttp\\Promise\\PromiseInterface' => __DIR__ . '/..' . '/guzzlehttp/promises/src/PromiseInterface.php',
        'GuzzleHttp\\Promise\\PromisorInterface' => __DIR__ . '/..' . '/guzzlehttp/promises/src/PromisorInterface.php',
        'GuzzleHttp\\Promise\\RejectedPromise' => __DIR__ . '/..' . '/guzzlehttp/promises/src/RejectedPromise.php',
        'GuzzleHttp\\Promise\\RejectionException' => __DIR__ . '/..' . '/guzzlehttp/promises/src/RejectionException.php',
        'GuzzleHttp\\Promise\\TaskQueue' => __DIR__ . '/..' . '/guzzlehttp/promises/src/TaskQueue.php',
        'GuzzleHttp\\Promise\\TaskQueueInterface' => __DIR__ . '/..' . '/guzzlehttp/promises/src/TaskQueueInterface.php',
        'GuzzleHttp\\Promise\\Utils' => __DIR__ . '/..' . '/guzzlehttp/promises/src/Utils.php',
        'GuzzleHttp\\Psr7\\AppendStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/AppendStream.php',
        'GuzzleHttp\\Psr7\\BufferStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/BufferStream.php',
        'GuzzleHttp\\Psr7\\CachingStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/CachingStream.php',
        'GuzzleHttp\\Psr7\\DroppingStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/DroppingStream.php',
        'GuzzleHttp\\Psr7\\FnStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/FnStream.php',
        'GuzzleHttp\\Psr7\\Header' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Header.php',
        'GuzzleHttp\\Psr7\\InflateStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/InflateStream.php',
        'GuzzleHttp\\Psr7\\LazyOpenStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/LazyOpenStream.php',
        'GuzzleHttp\\Psr7\\LimitStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/LimitStream.php',
        'GuzzleHttp\\Psr7\\Message' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Message.php',
        'GuzzleHttp\\Psr7\\MessageTrait' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/MessageTrait.php',
        'GuzzleHttp\\Psr7\\MimeType' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/MimeType.php',
        'GuzzleHttp\\Psr7\\MultipartStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/MultipartStream.php',
        'GuzzleHttp\\Psr7\\NoSeekStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/NoSeekStream.php',
        'GuzzleHttp\\Psr7\\PumpStream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/PumpStream.php',
        'GuzzleHttp\\Psr7\\Query' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Query.php',
        'GuzzleHttp\\Psr7\\Request' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Request.php',
        'GuzzleHttp\\Psr7\\Response' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Response.php',
        'GuzzleHttp\\Psr7\\Rfc7230' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Rfc7230.php',
        'GuzzleHttp\\Psr7\\ServerRequest' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/ServerRequest.php',
        'GuzzleHttp\\Psr7\\Stream' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Stream.php',
        'GuzzleHttp\\Psr7\\StreamDecoratorTrait' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/StreamDecoratorTrait.php',
        'GuzzleHttp\\Psr7\\StreamWrapper' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/StreamWrapper.php',
        'GuzzleHttp\\Psr7\\UploadedFile' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/UploadedFile.php',
        'GuzzleHttp\\Psr7\\Uri' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Uri.php',
        'GuzzleHttp\\Psr7\\UriComparator' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/UriComparator.php',
        'GuzzleHttp\\Psr7\\UriNormalizer' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/UriNormalizer.php',
        'GuzzleHttp\\Psr7\\UriResolver' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/UriResolver.php',
        'GuzzleHttp\\Psr7\\Utils' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/Utils.php',
        'GuzzleHttp\\RedirectMiddleware' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/RedirectMiddleware.php',
        'GuzzleHttp\\RequestOptions' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/RequestOptions.php',
        'GuzzleHttp\\RetryMiddleware' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/RetryMiddleware.php',
        'GuzzleHttp\\TransferStats' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/TransferStats.php',
        'GuzzleHttp\\UriTemplate' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/UriTemplate.php',
        'GuzzleHttp\\Utils' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/Utils.php',
        'MyCLabs\\Enum\\Enum' => __DIR__ . '/..' . '/myclabs/php-enum/src/Enum.php',
        'MyCLabs\\Enum\\PHPUnit\\Comparator' => __DIR__ . '/..' . '/myclabs/php-enum/src/PHPUnit/Comparator.php',
        'Normalizer' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/Resources/stubs/Normalizer.php',
        'Psr\\Http\\Message\\MessageInterface' => __DIR__ . '/..' . '/psr/http-message/src/MessageInterface.php',
        'Psr\\Http\\Message\\RequestInterface' => __DIR__ . '/..' . '/psr/http-message/src/RequestInterface.php',
        'Psr\\Http\\Message\\ResponseInterface' => __DIR__ . '/..' . '/psr/http-message/src/ResponseInterface.php',
        'Psr\\Http\\Message\\ServerRequestInterface' => __DIR__ . '/..' . '/psr/http-message/src/ServerRequestInterface.php',
        'Psr\\Http\\Message\\StreamInterface' => __DIR__ . '/..' . '/psr/http-message/src/StreamInterface.php',
        'Psr\\Http\\Message\\UploadedFileInterface' => __DIR__ . '/..' . '/psr/http-message/src/UploadedFileInterface.php',
        'Psr\\Http\\Message\\UriInterface' => __DIR__ . '/..' . '/psr/http-message/src/UriInterface.php',
        'Psr\\Log\\AbstractLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/AbstractLogger.php',
        'Psr\\Log\\InvalidArgumentException' => __DIR__ . '/..' . '/psr/log/Psr/Log/InvalidArgumentException.php',
        'Psr\\Log\\LogLevel' => __DIR__ . '/..' . '/psr/log/Psr/Log/LogLevel.php',
        'Psr\\Log\\LoggerAwareInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareInterface.php',
        'Psr\\Log\\LoggerAwareTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareTrait.php',
        'Psr\\Log\\LoggerInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerInterface.php',
        'Psr\\Log\\LoggerTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerTrait.php',
        'Psr\\Log\\NullLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/NullLogger.php',
        'Psr\\Log\\Test\\DummyTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/DummyTest.php',
        'Psr\\Log\\Test\\LoggerInterfaceTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
        'Psr\\Log\\Test\\TestLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/TestLogger.php',
        'Psr\\SimpleCache\\CacheException' => __DIR__ . '/..' . '/psr/simple-cache/src/CacheException.php',
        'Psr\\SimpleCache\\CacheInterface' => __DIR__ . '/..' . '/psr/simple-cache/src/CacheInterface.php',
        'Psr\\SimpleCache\\InvalidArgumentException' => __DIR__ . '/..' . '/psr/simple-cache/src/InvalidArgumentException.php',
        'Symfony\\Polyfill\\Intl\\Idn\\Idn' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/Idn.php',
        'Symfony\\Polyfill\\Intl\\Idn\\Info' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/Info.php',
        'Symfony\\Polyfill\\Intl\\Idn\\Resources\\unidata\\DisallowedRanges' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/Resources/unidata/DisallowedRanges.php',
        'Symfony\\Polyfill\\Intl\\Idn\\Resources\\unidata\\Regex' => __DIR__ . '/..' . '/symfony/polyfill-intl-idn/Resources/unidata/Regex.php',
        'Symfony\\Polyfill\\Intl\\Normalizer\\Normalizer' => __DIR__ . '/..' . '/symfony/polyfill-intl-normalizer/Normalizer.php',
        'Symfony\\Polyfill\\Php72\\Php72' => __DIR__ . '/..' . '/symfony/polyfill-php72/Php72.php',
        'Wa72\\SimpleLogger\\AbstractSimpleLogger' => __DIR__ . '/..' . '/wa72/simplelogger/Wa72/SimpleLogger/AbstractSimpleLogger.php',
        'Wa72\\SimpleLogger\\ArrayLogger' => __DIR__ . '/..' . '/wa72/simplelogger/Wa72/SimpleLogger/ArrayLogger.php',
        'Wa72\\SimpleLogger\\ConsoleLogger' => __DIR__ . '/..' . '/wa72/simplelogger/Wa72/SimpleLogger/ConsoleLogger.php',
        'Wa72\\SimpleLogger\\EchoLogger' => __DIR__ . '/..' . '/wa72/simplelogger/Wa72/SimpleLogger/EchoLogger.php',
        'Wa72\\SimpleLogger\\FileLogger' => __DIR__ . '/..' . '/wa72/simplelogger/Wa72/SimpleLogger/FileLogger.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbe2252d99514ef070c626c30540e0d4c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbe2252d99514ef070c626c30540e0d4c::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitbe2252d99514ef070c626c30540e0d4c::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitbe2252d99514ef070c626c30540e0d4c::$classMap;

        }, null, ClassLoader::class);
    }
}
