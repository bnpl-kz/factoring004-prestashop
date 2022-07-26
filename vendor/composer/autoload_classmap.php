<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'BnplPartners\\Factoring004Prestashop\\Controller\\FileHandlerController' => $baseDir . '/src/Controller/FileHandlerController.php',
    'BnplPartners\\Factoring004Prestashop\\Controller\\OrderController' => $baseDir . '/src/Controller/OrderController.php',
    'BnplPartners\\Factoring004Prestashop\\Controller\\OtpController' => $baseDir . '/src/Controller/OtpController.php',
    'BnplPartners\\Factoring004Prestashop\\Form\\ChangeOrdersStatusType' => $baseDir . '/src/Form/ChangeOrdersStatusType.php',
    'BnplPartners\\Factoring004Prestashop\\Handler\\AbstractOrderStatusHandler' => $baseDir . '/src/Handler/AbstractOrderStatusHandler.php',
    'BnplPartners\\Factoring004Prestashop\\Handler\\AbstractOrderStatusRefundHandler' => $baseDir . '/src/Handler/AbstractOrderStatusRefundHandler.php',
    'BnplPartners\\Factoring004Prestashop\\Handler\\CancelHandler' => $baseDir . '/src/Handler/CancelHandler.php',
    'BnplPartners\\Factoring004Prestashop\\Handler\\DeliveryHandler' => $baseDir . '/src/Handler/DeliveryHandler.php',
    'BnplPartners\\Factoring004Prestashop\\Handler\\FullRefundHandler' => $baseDir . '/src/Handler/FullRefundHandler.php',
    'BnplPartners\\Factoring004Prestashop\\Handler\\OrderStatusHandlerInterface' => $baseDir . '/src/Handler/OrderStatusHandlerInterface.php',
    'BnplPartners\\Factoring004Prestashop\\Handler\\PartialRefundHandler' => $baseDir . '/src/Handler/PartialRefundHandler.php',
    'BnplPartners\\Factoring004Prestashop\\Otp\\DeliveryOtpChecker' => $baseDir . '/src/Otp/DeliveryOtpChecker.php',
    'BnplPartners\\Factoring004Prestashop\\Otp\\OtpCheckerInterface' => $baseDir . '/src/Otp/OtpCheckerInterface.php',
    'BnplPartners\\Factoring004Prestashop\\Otp\\RefundOtpChecker' => $baseDir . '/src/Otp/RefundOtpChecker.php',
    'BnplPartners\\Factoring004\\AbstractResource' => $vendorDir . '/bnpl-partners/factoring004/src/AbstractResource.php',
    'BnplPartners\\Factoring004\\Api' => $vendorDir . '/bnpl-partners/factoring004/src/Api.php',
    'BnplPartners\\Factoring004\\ArrayInterface' => $vendorDir . '/bnpl-partners/factoring004/src/ArrayInterface.php',
    'BnplPartners\\Factoring004\\Auth\\ApiKeyAuth' => $vendorDir . '/bnpl-partners/factoring004/src/Auth/ApiKeyAuth.php',
    'BnplPartners\\Factoring004\\Auth\\AuthenticationInterface' => $vendorDir . '/bnpl-partners/factoring004/src/Auth/AuthenticationInterface.php',
    'BnplPartners\\Factoring004\\Auth\\BasicAuth' => $vendorDir . '/bnpl-partners/factoring004/src/Auth/BasicAuth.php',
    'BnplPartners\\Factoring004\\Auth\\BearerTokenAuth' => $vendorDir . '/bnpl-partners/factoring004/src/Auth/BearerTokenAuth.php',
    'BnplPartners\\Factoring004\\Auth\\NoAuth' => $vendorDir . '/bnpl-partners/factoring004/src/Auth/NoAuth.php',
    'BnplPartners\\Factoring004\\ChangeStatus\\AbstractMerchantOrder' => $vendorDir . '/bnpl-partners/factoring004/src/ChangeStatus/AbstractMerchantOrder.php',
    'BnplPartners\\Factoring004\\ChangeStatus\\CancelOrder' => $vendorDir . '/bnpl-partners/factoring004/src/ChangeStatus/CancelOrder.php',
    'BnplPartners\\Factoring004\\ChangeStatus\\CancelStatus' => $vendorDir . '/bnpl-partners/factoring004/src/ChangeStatus/CancelStatus.php',
    'BnplPartners\\Factoring004\\ChangeStatus\\ChangeStatusResource' => $vendorDir . '/bnpl-partners/factoring004/src/ChangeStatus/ChangeStatusResource.php',
    'BnplPartners\\Factoring004\\ChangeStatus\\ChangeStatusResponse' => $vendorDir . '/bnpl-partners/factoring004/src/ChangeStatus/ChangeStatusResponse.php',
    'BnplPartners\\Factoring004\\ChangeStatus\\DeliveryOrder' => $vendorDir . '/bnpl-partners/factoring004/src/ChangeStatus/DeliveryOrder.php',
    'BnplPartners\\Factoring004\\ChangeStatus\\DeliveryStatus' => $vendorDir . '/bnpl-partners/factoring004/src/ChangeStatus/DeliveryStatus.php',
    'BnplPartners\\Factoring004\\ChangeStatus\\ErrorResponse' => $vendorDir . '/bnpl-partners/factoring004/src/ChangeStatus/ErrorResponse.php',
    'BnplPartners\\Factoring004\\ChangeStatus\\MerchantsOrders' => $vendorDir . '/bnpl-partners/factoring004/src/ChangeStatus/MerchantsOrders.php',
    'BnplPartners\\Factoring004\\ChangeStatus\\ReturnOrder' => $vendorDir . '/bnpl-partners/factoring004/src/ChangeStatus/ReturnOrder.php',
    'BnplPartners\\Factoring004\\ChangeStatus\\ReturnStatus' => $vendorDir . '/bnpl-partners/factoring004/src/ChangeStatus/ReturnStatus.php',
    'BnplPartners\\Factoring004\\ChangeStatus\\SuccessResponse' => $vendorDir . '/bnpl-partners/factoring004/src/ChangeStatus/SuccessResponse.php',
    'BnplPartners\\Factoring004\\Exception\\ApiException' => $vendorDir . '/bnpl-partners/factoring004/src/Exception/ApiException.php',
    'BnplPartners\\Factoring004\\Exception\\AuthenticationException' => $vendorDir . '/bnpl-partners/factoring004/src/Exception/AuthenticationException.php',
    'BnplPartners\\Factoring004\\Exception\\DataSerializationException' => $vendorDir . '/bnpl-partners/factoring004/src/Exception/DataSerializationException.php',
    'BnplPartners\\Factoring004\\Exception\\EndpointUnavailableException' => $vendorDir . '/bnpl-partners/factoring004/src/Exception/EndpointUnavailableException.php',
    'BnplPartners\\Factoring004\\Exception\\ErrorResponseException' => $vendorDir . '/bnpl-partners/factoring004/src/Exception/ErrorResponseException.php',
    'BnplPartners\\Factoring004\\Exception\\InvalidSignatureException' => $vendorDir . '/bnpl-partners/factoring004/src/Exception/InvalidSignatureException.php',
    'BnplPartners\\Factoring004\\Exception\\NetworkException' => $vendorDir . '/bnpl-partners/factoring004/src/Exception/NetworkException.php',
    'BnplPartners\\Factoring004\\Exception\\OAuthException' => $vendorDir . '/bnpl-partners/factoring004/src/Exception/OAuthException.php',
    'BnplPartners\\Factoring004\\Exception\\PackageException' => $vendorDir . '/bnpl-partners/factoring004/src/Exception/PackageException.php',
    'BnplPartners\\Factoring004\\Exception\\TransportException' => $vendorDir . '/bnpl-partners/factoring004/src/Exception/TransportException.php',
    'BnplPartners\\Factoring004\\Exception\\UnexpectedResponseException' => $vendorDir . '/bnpl-partners/factoring004/src/Exception/UnexpectedResponseException.php',
    'BnplPartners\\Factoring004\\Exception\\ValidationException' => $vendorDir . '/bnpl-partners/factoring004/src/Exception/ValidationException.php',
    'BnplPartners\\Factoring004\\OAuth\\CacheOAuthTokenManager' => $vendorDir . '/bnpl-partners/factoring004/src/OAuth/CacheOAuthTokenManager.php',
    'BnplPartners\\Factoring004\\OAuth\\OAuthToken' => $vendorDir . '/bnpl-partners/factoring004/src/OAuth/OAuthToken.php',
    'BnplPartners\\Factoring004\\OAuth\\OAuthTokenManager' => $vendorDir . '/bnpl-partners/factoring004/src/OAuth/OAuthTokenManager.php',
    'BnplPartners\\Factoring004\\OAuth\\OAuthTokenManagerInterface' => $vendorDir . '/bnpl-partners/factoring004/src/OAuth/OAuthTokenManagerInterface.php',
    'BnplPartners\\Factoring004\\Otp\\CheckOtp' => $vendorDir . '/bnpl-partners/factoring004/src/Otp/CheckOtp.php',
    'BnplPartners\\Factoring004\\Otp\\CheckOtpReturn' => $vendorDir . '/bnpl-partners/factoring004/src/Otp/CheckOtpReturn.php',
    'BnplPartners\\Factoring004\\Otp\\DtoOtp' => $vendorDir . '/bnpl-partners/factoring004/src/Otp/DtoOtp.php',
    'BnplPartners\\Factoring004\\Otp\\OtpResource' => $vendorDir . '/bnpl-partners/factoring004/src/Otp/OtpResource.php',
    'BnplPartners\\Factoring004\\Otp\\SendOtp' => $vendorDir . '/bnpl-partners/factoring004/src/Otp/SendOtp.php',
    'BnplPartners\\Factoring004\\Otp\\SendOtpReturn' => $vendorDir . '/bnpl-partners/factoring004/src/Otp/SendOtpReturn.php',
    'BnplPartners\\Factoring004\\PreApp\\DeliveryPoint' => $vendorDir . '/bnpl-partners/factoring004/src/PreApp/DeliveryPoint.php',
    'BnplPartners\\Factoring004\\PreApp\\Item' => $vendorDir . '/bnpl-partners/factoring004/src/PreApp/Item.php',
    'BnplPartners\\Factoring004\\PreApp\\PartnerData' => $vendorDir . '/bnpl-partners/factoring004/src/PreApp/PartnerData.php',
    'BnplPartners\\Factoring004\\PreApp\\PreAppMessage' => $vendorDir . '/bnpl-partners/factoring004/src/PreApp/PreAppMessage.php',
    'BnplPartners\\Factoring004\\PreApp\\PreAppResource' => $vendorDir . '/bnpl-partners/factoring004/src/PreApp/PreAppResource.php',
    'BnplPartners\\Factoring004\\PreApp\\Status' => $vendorDir . '/bnpl-partners/factoring004/src/PreApp/Status.php',
    'BnplPartners\\Factoring004\\PreApp\\ValidationErrorDetail' => $vendorDir . '/bnpl-partners/factoring004/src/PreApp/ValidationErrorDetail.php',
    'BnplPartners\\Factoring004\\Response\\ErrorResponse' => $vendorDir . '/bnpl-partners/factoring004/src/Response/ErrorResponse.php',
    'BnplPartners\\Factoring004\\Response\\PreAppResponse' => $vendorDir . '/bnpl-partners/factoring004/src/Response/PreAppResponse.php',
    'BnplPartners\\Factoring004\\Response\\ValidationErrorResponse' => $vendorDir . '/bnpl-partners/factoring004/src/Response/ValidationErrorResponse.php',
    'BnplPartners\\Factoring004\\Signature\\PostLinkSignatureCalculator' => $vendorDir . '/bnpl-partners/factoring004/src/Signature/PostLinkSignatureCalculator.php',
    'BnplPartners\\Factoring004\\Signature\\PostLinkSignatureValidator' => $vendorDir . '/bnpl-partners/factoring004/src/Signature/PostLinkSignatureValidator.php',
    'BnplPartners\\Factoring004\\Transport\\AbstractTransport' => $vendorDir . '/bnpl-partners/factoring004/src/Transport/AbstractTransport.php',
    'BnplPartners\\Factoring004\\Transport\\GuzzleTransport' => $vendorDir . '/bnpl-partners/factoring004/src/Transport/GuzzleTransport.php',
    'BnplPartners\\Factoring004\\Transport\\PsrTransport' => $vendorDir . '/bnpl-partners/factoring004/src/Transport/PsrTransport.php',
    'BnplPartners\\Factoring004\\Transport\\Response' => $vendorDir . '/bnpl-partners/factoring004/src/Transport/Response.php',
    'BnplPartners\\Factoring004\\Transport\\ResponseInterface' => $vendorDir . '/bnpl-partners/factoring004/src/Transport/ResponseInterface.php',
    'BnplPartners\\Factoring004\\Transport\\TransportInterface' => $vendorDir . '/bnpl-partners/factoring004/src/Transport/TransportInterface.php',
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'GuzzleHttp\\Client' => $vendorDir . '/guzzlehttp/guzzle/src/Client.php',
    'GuzzleHttp\\ClientInterface' => $vendorDir . '/guzzlehttp/guzzle/src/ClientInterface.php',
    'GuzzleHttp\\Cookie\\CookieJar' => $vendorDir . '/guzzlehttp/guzzle/src/Cookie/CookieJar.php',
    'GuzzleHttp\\Cookie\\CookieJarInterface' => $vendorDir . '/guzzlehttp/guzzle/src/Cookie/CookieJarInterface.php',
    'GuzzleHttp\\Cookie\\FileCookieJar' => $vendorDir . '/guzzlehttp/guzzle/src/Cookie/FileCookieJar.php',
    'GuzzleHttp\\Cookie\\SessionCookieJar' => $vendorDir . '/guzzlehttp/guzzle/src/Cookie/SessionCookieJar.php',
    'GuzzleHttp\\Cookie\\SetCookie' => $vendorDir . '/guzzlehttp/guzzle/src/Cookie/SetCookie.php',
    'GuzzleHttp\\Exception\\BadResponseException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/BadResponseException.php',
    'GuzzleHttp\\Exception\\ClientException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/ClientException.php',
    'GuzzleHttp\\Exception\\ConnectException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/ConnectException.php',
    'GuzzleHttp\\Exception\\GuzzleException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/GuzzleException.php',
    'GuzzleHttp\\Exception\\InvalidArgumentException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/InvalidArgumentException.php',
    'GuzzleHttp\\Exception\\RequestException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/RequestException.php',
    'GuzzleHttp\\Exception\\SeekException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/SeekException.php',
    'GuzzleHttp\\Exception\\ServerException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/ServerException.php',
    'GuzzleHttp\\Exception\\TooManyRedirectsException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/TooManyRedirectsException.php',
    'GuzzleHttp\\Exception\\TransferException' => $vendorDir . '/guzzlehttp/guzzle/src/Exception/TransferException.php',
    'GuzzleHttp\\HandlerStack' => $vendorDir . '/guzzlehttp/guzzle/src/HandlerStack.php',
    'GuzzleHttp\\Handler\\CurlFactory' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/CurlFactory.php',
    'GuzzleHttp\\Handler\\CurlFactoryInterface' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/CurlFactoryInterface.php',
    'GuzzleHttp\\Handler\\CurlHandler' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/CurlHandler.php',
    'GuzzleHttp\\Handler\\CurlMultiHandler' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/CurlMultiHandler.php',
    'GuzzleHttp\\Handler\\EasyHandle' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/EasyHandle.php',
    'GuzzleHttp\\Handler\\MockHandler' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/MockHandler.php',
    'GuzzleHttp\\Handler\\Proxy' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/Proxy.php',
    'GuzzleHttp\\Handler\\StreamHandler' => $vendorDir . '/guzzlehttp/guzzle/src/Handler/StreamHandler.php',
    'GuzzleHttp\\MessageFormatter' => $vendorDir . '/guzzlehttp/guzzle/src/MessageFormatter.php',
    'GuzzleHttp\\Middleware' => $vendorDir . '/guzzlehttp/guzzle/src/Middleware.php',
    'GuzzleHttp\\Pool' => $vendorDir . '/guzzlehttp/guzzle/src/Pool.php',
    'GuzzleHttp\\PrepareBodyMiddleware' => $vendorDir . '/guzzlehttp/guzzle/src/PrepareBodyMiddleware.php',
    'GuzzleHttp\\Promise\\AggregateException' => $vendorDir . '/guzzlehttp/promises/src/AggregateException.php',
    'GuzzleHttp\\Promise\\CancellationException' => $vendorDir . '/guzzlehttp/promises/src/CancellationException.php',
    'GuzzleHttp\\Promise\\Coroutine' => $vendorDir . '/guzzlehttp/promises/src/Coroutine.php',
    'GuzzleHttp\\Promise\\Create' => $vendorDir . '/guzzlehttp/promises/src/Create.php',
    'GuzzleHttp\\Promise\\Each' => $vendorDir . '/guzzlehttp/promises/src/Each.php',
    'GuzzleHttp\\Promise\\EachPromise' => $vendorDir . '/guzzlehttp/promises/src/EachPromise.php',
    'GuzzleHttp\\Promise\\FulfilledPromise' => $vendorDir . '/guzzlehttp/promises/src/FulfilledPromise.php',
    'GuzzleHttp\\Promise\\Is' => $vendorDir . '/guzzlehttp/promises/src/Is.php',
    'GuzzleHttp\\Promise\\Promise' => $vendorDir . '/guzzlehttp/promises/src/Promise.php',
    'GuzzleHttp\\Promise\\PromiseInterface' => $vendorDir . '/guzzlehttp/promises/src/PromiseInterface.php',
    'GuzzleHttp\\Promise\\PromisorInterface' => $vendorDir . '/guzzlehttp/promises/src/PromisorInterface.php',
    'GuzzleHttp\\Promise\\RejectedPromise' => $vendorDir . '/guzzlehttp/promises/src/RejectedPromise.php',
    'GuzzleHttp\\Promise\\RejectionException' => $vendorDir . '/guzzlehttp/promises/src/RejectionException.php',
    'GuzzleHttp\\Promise\\TaskQueue' => $vendorDir . '/guzzlehttp/promises/src/TaskQueue.php',
    'GuzzleHttp\\Promise\\TaskQueueInterface' => $vendorDir . '/guzzlehttp/promises/src/TaskQueueInterface.php',
    'GuzzleHttp\\Promise\\Utils' => $vendorDir . '/guzzlehttp/promises/src/Utils.php',
    'GuzzleHttp\\Psr7\\AppendStream' => $vendorDir . '/guzzlehttp/psr7/src/AppendStream.php',
    'GuzzleHttp\\Psr7\\BufferStream' => $vendorDir . '/guzzlehttp/psr7/src/BufferStream.php',
    'GuzzleHttp\\Psr7\\CachingStream' => $vendorDir . '/guzzlehttp/psr7/src/CachingStream.php',
    'GuzzleHttp\\Psr7\\DroppingStream' => $vendorDir . '/guzzlehttp/psr7/src/DroppingStream.php',
    'GuzzleHttp\\Psr7\\FnStream' => $vendorDir . '/guzzlehttp/psr7/src/FnStream.php',
    'GuzzleHttp\\Psr7\\Header' => $vendorDir . '/guzzlehttp/psr7/src/Header.php',
    'GuzzleHttp\\Psr7\\InflateStream' => $vendorDir . '/guzzlehttp/psr7/src/InflateStream.php',
    'GuzzleHttp\\Psr7\\LazyOpenStream' => $vendorDir . '/guzzlehttp/psr7/src/LazyOpenStream.php',
    'GuzzleHttp\\Psr7\\LimitStream' => $vendorDir . '/guzzlehttp/psr7/src/LimitStream.php',
    'GuzzleHttp\\Psr7\\Message' => $vendorDir . '/guzzlehttp/psr7/src/Message.php',
    'GuzzleHttp\\Psr7\\MessageTrait' => $vendorDir . '/guzzlehttp/psr7/src/MessageTrait.php',
    'GuzzleHttp\\Psr7\\MimeType' => $vendorDir . '/guzzlehttp/psr7/src/MimeType.php',
    'GuzzleHttp\\Psr7\\MultipartStream' => $vendorDir . '/guzzlehttp/psr7/src/MultipartStream.php',
    'GuzzleHttp\\Psr7\\NoSeekStream' => $vendorDir . '/guzzlehttp/psr7/src/NoSeekStream.php',
    'GuzzleHttp\\Psr7\\PumpStream' => $vendorDir . '/guzzlehttp/psr7/src/PumpStream.php',
    'GuzzleHttp\\Psr7\\Query' => $vendorDir . '/guzzlehttp/psr7/src/Query.php',
    'GuzzleHttp\\Psr7\\Request' => $vendorDir . '/guzzlehttp/psr7/src/Request.php',
    'GuzzleHttp\\Psr7\\Response' => $vendorDir . '/guzzlehttp/psr7/src/Response.php',
    'GuzzleHttp\\Psr7\\Rfc7230' => $vendorDir . '/guzzlehttp/psr7/src/Rfc7230.php',
    'GuzzleHttp\\Psr7\\ServerRequest' => $vendorDir . '/guzzlehttp/psr7/src/ServerRequest.php',
    'GuzzleHttp\\Psr7\\Stream' => $vendorDir . '/guzzlehttp/psr7/src/Stream.php',
    'GuzzleHttp\\Psr7\\StreamDecoratorTrait' => $vendorDir . '/guzzlehttp/psr7/src/StreamDecoratorTrait.php',
    'GuzzleHttp\\Psr7\\StreamWrapper' => $vendorDir . '/guzzlehttp/psr7/src/StreamWrapper.php',
    'GuzzleHttp\\Psr7\\UploadedFile' => $vendorDir . '/guzzlehttp/psr7/src/UploadedFile.php',
    'GuzzleHttp\\Psr7\\Uri' => $vendorDir . '/guzzlehttp/psr7/src/Uri.php',
    'GuzzleHttp\\Psr7\\UriComparator' => $vendorDir . '/guzzlehttp/psr7/src/UriComparator.php',
    'GuzzleHttp\\Psr7\\UriNormalizer' => $vendorDir . '/guzzlehttp/psr7/src/UriNormalizer.php',
    'GuzzleHttp\\Psr7\\UriResolver' => $vendorDir . '/guzzlehttp/psr7/src/UriResolver.php',
    'GuzzleHttp\\Psr7\\Utils' => $vendorDir . '/guzzlehttp/psr7/src/Utils.php',
    'GuzzleHttp\\RedirectMiddleware' => $vendorDir . '/guzzlehttp/guzzle/src/RedirectMiddleware.php',
    'GuzzleHttp\\RequestOptions' => $vendorDir . '/guzzlehttp/guzzle/src/RequestOptions.php',
    'GuzzleHttp\\RetryMiddleware' => $vendorDir . '/guzzlehttp/guzzle/src/RetryMiddleware.php',
    'GuzzleHttp\\TransferStats' => $vendorDir . '/guzzlehttp/guzzle/src/TransferStats.php',
    'GuzzleHttp\\UriTemplate' => $vendorDir . '/guzzlehttp/guzzle/src/UriTemplate.php',
    'GuzzleHttp\\Utils' => $vendorDir . '/guzzlehttp/guzzle/src/Utils.php',
    'Http\\Message\\MessageFactory' => $vendorDir . '/php-http/message-factory/src/MessageFactory.php',
    'Http\\Message\\RequestFactory' => $vendorDir . '/php-http/message-factory/src/RequestFactory.php',
    'Http\\Message\\ResponseFactory' => $vendorDir . '/php-http/message-factory/src/ResponseFactory.php',
    'Http\\Message\\StreamFactory' => $vendorDir . '/php-http/message-factory/src/StreamFactory.php',
    'Http\\Message\\UriFactory' => $vendorDir . '/php-http/message-factory/src/UriFactory.php',
    'MyCLabs\\Enum\\Enum' => $vendorDir . '/myclabs/php-enum/src/Enum.php',
    'MyCLabs\\Enum\\PHPUnit\\Comparator' => $vendorDir . '/myclabs/php-enum/src/PHPUnit/Comparator.php',
    'Normalizer' => $vendorDir . '/symfony/polyfill-intl-normalizer/Resources/stubs/Normalizer.php',
    'Nyholm\\Psr7\\Factory\\HttplugFactory' => $vendorDir . '/nyholm/psr7/src/Factory/HttplugFactory.php',
    'Nyholm\\Psr7\\Factory\\Psr17Factory' => $vendorDir . '/nyholm/psr7/src/Factory/Psr17Factory.php',
    'Nyholm\\Psr7\\MessageTrait' => $vendorDir . '/nyholm/psr7/src/MessageTrait.php',
    'Nyholm\\Psr7\\Request' => $vendorDir . '/nyholm/psr7/src/Request.php',
    'Nyholm\\Psr7\\RequestTrait' => $vendorDir . '/nyholm/psr7/src/RequestTrait.php',
    'Nyholm\\Psr7\\Response' => $vendorDir . '/nyholm/psr7/src/Response.php',
    'Nyholm\\Psr7\\ServerRequest' => $vendorDir . '/nyholm/psr7/src/ServerRequest.php',
    'Nyholm\\Psr7\\Stream' => $vendorDir . '/nyholm/psr7/src/Stream.php',
    'Nyholm\\Psr7\\UploadedFile' => $vendorDir . '/nyholm/psr7/src/UploadedFile.php',
    'Nyholm\\Psr7\\Uri' => $vendorDir . '/nyholm/psr7/src/Uri.php',
    'Psr\\Http\\Client\\ClientExceptionInterface' => $vendorDir . '/psr/http-client/src/ClientExceptionInterface.php',
    'Psr\\Http\\Client\\ClientInterface' => $vendorDir . '/psr/http-client/src/ClientInterface.php',
    'Psr\\Http\\Client\\NetworkExceptionInterface' => $vendorDir . '/psr/http-client/src/NetworkExceptionInterface.php',
    'Psr\\Http\\Client\\RequestExceptionInterface' => $vendorDir . '/psr/http-client/src/RequestExceptionInterface.php',
    'Psr\\Http\\Message\\MessageInterface' => $vendorDir . '/psr/http-message/src/MessageInterface.php',
    'Psr\\Http\\Message\\RequestFactoryInterface' => $vendorDir . '/psr/http-factory/src/RequestFactoryInterface.php',
    'Psr\\Http\\Message\\RequestInterface' => $vendorDir . '/psr/http-message/src/RequestInterface.php',
    'Psr\\Http\\Message\\ResponseFactoryInterface' => $vendorDir . '/psr/http-factory/src/ResponseFactoryInterface.php',
    'Psr\\Http\\Message\\ResponseInterface' => $vendorDir . '/psr/http-message/src/ResponseInterface.php',
    'Psr\\Http\\Message\\ServerRequestFactoryInterface' => $vendorDir . '/psr/http-factory/src/ServerRequestFactoryInterface.php',
    'Psr\\Http\\Message\\ServerRequestInterface' => $vendorDir . '/psr/http-message/src/ServerRequestInterface.php',
    'Psr\\Http\\Message\\StreamFactoryInterface' => $vendorDir . '/psr/http-factory/src/StreamFactoryInterface.php',
    'Psr\\Http\\Message\\StreamInterface' => $vendorDir . '/psr/http-message/src/StreamInterface.php',
    'Psr\\Http\\Message\\UploadedFileFactoryInterface' => $vendorDir . '/psr/http-factory/src/UploadedFileFactoryInterface.php',
    'Psr\\Http\\Message\\UploadedFileInterface' => $vendorDir . '/psr/http-message/src/UploadedFileInterface.php',
    'Psr\\Http\\Message\\UriFactoryInterface' => $vendorDir . '/psr/http-factory/src/UriFactoryInterface.php',
    'Psr\\Http\\Message\\UriInterface' => $vendorDir . '/psr/http-message/src/UriInterface.php',
    'Psr\\Log\\AbstractLogger' => $vendorDir . '/psr/log/Psr/Log/AbstractLogger.php',
    'Psr\\Log\\InvalidArgumentException' => $vendorDir . '/psr/log/Psr/Log/InvalidArgumentException.php',
    'Psr\\Log\\LogLevel' => $vendorDir . '/psr/log/Psr/Log/LogLevel.php',
    'Psr\\Log\\LoggerAwareInterface' => $vendorDir . '/psr/log/Psr/Log/LoggerAwareInterface.php',
    'Psr\\Log\\LoggerAwareTrait' => $vendorDir . '/psr/log/Psr/Log/LoggerAwareTrait.php',
    'Psr\\Log\\LoggerInterface' => $vendorDir . '/psr/log/Psr/Log/LoggerInterface.php',
    'Psr\\Log\\LoggerTrait' => $vendorDir . '/psr/log/Psr/Log/LoggerTrait.php',
    'Psr\\Log\\NullLogger' => $vendorDir . '/psr/log/Psr/Log/NullLogger.php',
    'Psr\\Log\\Test\\DummyTest' => $vendorDir . '/psr/log/Psr/Log/Test/DummyTest.php',
    'Psr\\Log\\Test\\LoggerInterfaceTest' => $vendorDir . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
    'Psr\\Log\\Test\\TestLogger' => $vendorDir . '/psr/log/Psr/Log/Test/TestLogger.php',
    'Psr\\SimpleCache\\CacheException' => $vendorDir . '/psr/simple-cache/src/CacheException.php',
    'Psr\\SimpleCache\\CacheInterface' => $vendorDir . '/psr/simple-cache/src/CacheInterface.php',
    'Psr\\SimpleCache\\InvalidArgumentException' => $vendorDir . '/psr/simple-cache/src/InvalidArgumentException.php',
    'Symfony\\Polyfill\\Intl\\Idn\\Idn' => $vendorDir . '/symfony/polyfill-intl-idn/Idn.php',
    'Symfony\\Polyfill\\Intl\\Idn\\Info' => $vendorDir . '/symfony/polyfill-intl-idn/Info.php',
    'Symfony\\Polyfill\\Intl\\Idn\\Resources\\unidata\\DisallowedRanges' => $vendorDir . '/symfony/polyfill-intl-idn/Resources/unidata/DisallowedRanges.php',
    'Symfony\\Polyfill\\Intl\\Idn\\Resources\\unidata\\Regex' => $vendorDir . '/symfony/polyfill-intl-idn/Resources/unidata/Regex.php',
    'Symfony\\Polyfill\\Intl\\Normalizer\\Normalizer' => $vendorDir . '/symfony/polyfill-intl-normalizer/Normalizer.php',
    'Symfony\\Polyfill\\Php72\\Php72' => $vendorDir . '/symfony/polyfill-php72/Php72.php',
    'Wa72\\SimpleLogger\\AbstractSimpleLogger' => $vendorDir . '/wa72/simplelogger/Wa72/SimpleLogger/AbstractSimpleLogger.php',
    'Wa72\\SimpleLogger\\ArrayLogger' => $vendorDir . '/wa72/simplelogger/Wa72/SimpleLogger/ArrayLogger.php',
    'Wa72\\SimpleLogger\\ConsoleLogger' => $vendorDir . '/wa72/simplelogger/Wa72/SimpleLogger/ConsoleLogger.php',
    'Wa72\\SimpleLogger\\EchoLogger' => $vendorDir . '/wa72/simplelogger/Wa72/SimpleLogger/EchoLogger.php',
    'Wa72\\SimpleLogger\\FileLogger' => $vendorDir . '/wa72/simplelogger/Wa72/SimpleLogger/FileLogger.php',
);
