<?php

declare(strict_types=1);

use BnplPartners\Factoring004\Api;
use BnplPartners\Factoring004\Auth\BearerTokenAuth;
use BnplPartners\Factoring004\PreApp\PreAppMessage;
use BnplPartners\Factoring004Prestashop\Helper\AuthTokenManager;

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

        try {
            ToolsCore::redirect($this->preapp($cart));
        } catch (Exception $e) {
            PrestaShopLoggerCore::addLog($e->getMessage());
            $this->context->smarty->assign([
                'errorPageCss' => _MODULE_DIR_ . 'factoring004/assets/css/factoring004-errorpage.css',
            ]);
            $this->setTemplate('module:factoring004/views/templates/factoring004-errorpage.tpl');
        }
    }

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
            new BearerTokenAuth(AuthTokenManager::init($transport)->getToken()),
            $transport
        );

        $message = PreAppMessage::createFromArray([
            'partnerData' => [
                'partnerName' => (string) ConfigurationCore::get('FACTORING004_PARTNER_NAME'),
                'partnerCode' => (string) ConfigurationCore::get('FACTORING004_PARTNER_CODE'),
                'pointCode' => (string) ConfigurationCore::get('FACTORING004_POINT_CODE'),
                'partnerEmail' => (string) ConfigurationCore::get('FACTORING004_PARTNER_EMAIL'),
                'partnerWebsite' => (string) ConfigurationCore::get('FACTORING004_PARTNER_WEBSITE'),
            ],
            'billNumber' => (string) OrderCore::getIdByCartId($cart->id),
            'billAmount' => (int) ceil($cart->getOrderTotal()),
            'itemsQuantity' => (int) array_sum(array_map(function ($item) {
                return $item['cart_quantity'];
            },$cart->getProducts())),
            'items' => array_values(array_map(function ($item) {
                return [
                    'itemId' => (string) $item['id_product'],
                    'itemName' => (string) $item['name'],
                    'itemCategory' => (string) $item['category'],
                    'itemQuantity' => (int) $item['cart_quantity'],
                    'itemPrice' => (int) ceil($item['price']),
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

        return $api->preApps->preApp($message)->getRedirectLink();
    }
}