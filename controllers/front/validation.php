<?php

declare(strict_types=1);

use BnplPartners\Factoring004\Api;
use BnplPartners\Factoring004\Auth\BearerTokenAuth;
use BnplPartners\Factoring004\Exception\PackageException;
use BnplPartners\Factoring004\PreApp\PreAppMessage;

require_once _PS_ROOT_DIR_  . '/modules/factoring004/vendor/autoload.php' ;

class Factoring004ValidationModuleFrontController extends ModuleFrontControllerCore
{
    public function postProcess(): void
    {
        $cart = $this->context->cart;
        $authorized = false;

        if (!$this->module->active || $cart->id_customer == 0 || $cart->id_address_delivery == 0
            || $cart->id_address_invoice == 0) {
            ToolsCore::redirect('index.php?controller=order&step=1');
        }

        foreach (ModuleCore::getPaymentModules() as $module) {
            if ($module['name'] === 'factoring004') {
                $authorized = true;
                break;
            }
        }

        if (!$authorized) {
            die($this->l('This payment method is not available.'));
        }

        $customer = new CustomerCore($cart->id_customer);

        if (!ValidateCore::isLoadedObject($customer)) {
            ToolsCore::redirect('index.php?controller=order&step=1');
        }

        $this->module->validateOrder(
            (int) $cart->id,
            ConfigurationCore::get('PS_OS_FACTORING004'),
            (float) $cart->getOrderTotal(true, CartCore::BOTH),
            $this->module->displayName,
            null,
            null,
            (int) $this->context->currency->id,
            false,
            $customer->secure_key
        );

        ToolsCore::redirect($this->preapp($cart));
    }

    /**
     * @throws \BnplPartners\Factoring004\Exception\ApiException
     * @throws \BnplPartners\Factoring004\Exception\ValidationException
     * @throws \BnplPartners\Factoring004\Exception\ErrorResponseException
     * @throws \BnplPartners\Factoring004\Exception\NetworkException
     * @throws \BnplPartners\Factoring004\Exception\UnexpectedResponseException
     * @throws \BnplPartners\Factoring004\Exception\EndpointUnavailableException
     * @throws \BnplPartners\Factoring004\Exception\TransportException
     * @throws \BnplPartners\Factoring004\Exception\AuthenticationException
     */
    private function preApp($cart): string
    {
        $transport = new \BnplPartners\Factoring004\Transport\PsrTransport(
            new \Symfony\Component\HttpClient\Psr18Client(),
            new \Symfony\Component\HttpClient\Psr18Client(),
            new \Symfony\Component\HttpClient\Psr18Client(),
            new \Symfony\Component\HttpClient\Psr18Client()
        );
        $transport->setLogger(new \PrestaShop\PrestaShop\Adapter\LegacyLogger());
        $api = Api::create(
            ConfigurationCore::get('FACTORING004_API_HOST'),
            new BearerTokenAuth(ConfigurationCore::get('FACTORING004_PA_TOKEN')),
            $transport
        );

        try {
            $message = PreAppMessage::createFromArray([
                'partnerData' => [
                    'partnerName' => (string) ConfigurationCore::get('FACTORING004_PARTNER_NAME'),
                    'partnerCode' => (string) ConfigurationCore::get('FACTORING004_PARTNER_CODE'),
                    'pointCode' => (string) ConfigurationCore::get('FACTORING004_POINT_CODE'),
                    'partnerEmail' => (string) ConfigurationCore::get('FACTORING004_PARTNER_EMAIL'),
                    'partnerWebsite' => (string) ConfigurationCore::get('FACTORING004_PARTNER_WEBSITE'),
                ],
                'billNumber' => (string) OrderCore::getIdByCartId($cart->id),
                'billAmount' => (int) $cart->getOrderTotal(),
                'itemsQuantity' => (int) array_sum(array_map(function ($item) {
                    return $item['cart_quantity'];
                },$cart->getProducts())),
                'items' => array_values(array_map(function ($item) {
                    return [
                        'itemId' => (string) $item['id_product'],
                        'itemName' => (string) $item['name'],
                        'itemCategory' => (string) $item['category'],
                        'itemQuantity' => (int) $item['cart_quantity'],
                        'itemPrice' => (int) $item['price'],
                        'itemSum' => (int) ceil($item['total']),
                    ];
                }, $cart->getProducts())),
                'successRedirect' => _PS_BASE_URL_SSL_,
                'failRedirect' => _PS_BASE_URL_SSL_,
                'postLink' => $this->context->link->getModuleLink($this->module->name, 'postlink', array(), true),
                'phoneNumber' => $cart->getAddressCollection()[$cart->id_address_delivery]->phone
                    ? preg_replace('/^8|\+7/', '7', $cart->getAddressCollection()[$cart->id_address_delivery]->phone)
                    : null,
                'deliveryPoint' => [
                    'region' => (string) $cart->getAddressCollection()[$cart->id_address_delivery]->country,
                    'district' => (string) $cart->getAddressCollection()[$cart->id_address_delivery]->city,
                    'city' => (string) $cart->getAddressCollection()[$cart->id_address_delivery]->city,
                    'street' => $cart->getAddressCollection()[$cart->id_address_delivery]->address1 . ' ' . $cart->getAddressCollection()[$cart->id_address_delivery]->address2
                ],
            ]);

        } catch (PackageException $e) {
            PrestaShopLoggerCore::addLog($e->getMessage());
            $this->errors[] = 'An error occurred';
            return $this->redirectWithNotifications('');
        }

        return $api->preApps->preApp($message)->getRedirectLink();
    }
}