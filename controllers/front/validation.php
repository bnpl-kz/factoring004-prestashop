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

        $clientRoute = ConfigurationCore::get('FACTORING004_CLIENT_ROUTE');
        if (empty($cart->id)) {
            if ($orderId = $this->context->cookie->__get('factoring_current_order_id')) {
                $order = new OrderCore($orderId);
            } else {
                $this->returnErrorPage();
            }
        } else {
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
            $order = OrderCore::getByCartId($cart->id);
            $this->context->cookie->__set('factoring_current_order_id', $order->id);
        }


        try {
            $redirectLink = $this->preapp($order);
            if ($clientRoute == 'MODAL') {
                die(
                ToolsCore::jsonEncode(['redirectLink' => $redirectLink])
                );
            } else {
                ToolsCore::redirect($redirectLink);
            }
        } catch (Exception $e) {
            PrestaShopLoggerCore::addLog($e->getMessage());
            $this->returnErrorPage();
        }
    }

    private function returnErrorPage()
    {
        $clientRoute = ConfigurationCore::get('FACTORING004_CLIENT_ROUTE');
        $errorPageUrl = $this->context->link->getModuleLink('factoring004', 'error', array(), true);
        if ($clientRoute == 'MODAL') {
            die(
            ToolsCore::jsonEncode(['redirectErrorPage' => $errorPageUrl])
            );
        } else {
            ToolsCore::redirect($errorPageUrl);
        }
    }

    private function preApp($order): string
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

        $preappData = [
            'partnerData' => [
                'partnerName' => (string) ConfigurationCore::get('FACTORING004_PARTNER_NAME'),
                'partnerCode' => (string) ConfigurationCore::get('FACTORING004_PARTNER_CODE'),
                'pointCode' => (string) ConfigurationCore::get('FACTORING004_POINT_CODE'),
                'partnerEmail' => (string) ConfigurationCore::get('FACTORING004_PARTNER_EMAIL'),
                'partnerWebsite' => (string) ConfigurationCore::get('FACTORING004_PARTNER_WEBSITE'),
            ],
            'billNumber' => (string) $order->id,
            'billAmount' => (int) ceil($order->total_paid),
            'itemsQuantity' => (int) array_sum(array_map(function ($item) {
                return $item['cart_quantity'];
            },$order->getCartProducts())),
            'items' => array_values(array_map(function ($item) {
                $categories = ProductCore::getProductCategoriesFull($item['id_product']);
                return [
                    'itemId' => (string) $item['id_product'],
                    'itemName' => (string) $item['product_name'],
                    'itemCategory' => empty($categories) ? '' : implode(',', array_column($categories, 'name')),
                    'itemQuantity' => (int) $item['product_quantity'],
                    'itemPrice' => (int) ceil($item['price']),
                    'itemSum' => (int) ceil($item['total_price']),
                ];
            }, $order->getCartProducts())),
            'successRedirect' => _PS_BASE_URL_SSL_,
            'failRedirect' => _PS_BASE_URL_SSL_,
            'postLink' => $this->context->link->getModuleLink($this->module->name, 'postlink', array(), true),
            'phoneNumber' => null
        ];
        $addresses = $order->getCustomer()->getAddresses($order->id_lang);
        if (!empty($addresses)) {
            $preappData['deliveryPoint'] = [
                'region' => (string) $addresses[0]['country'],
                'district' => (string) $addresses[0]['city'],
                'city' => (string) $addresses[0]['city'],
                'street' => $addresses[0]['address1'] . ' ' . $addresses[0]['address2']
            ];
            $preappData['phoneNumber'] = $addresses[0]['phone']
                ? preg_replace('/^8|\+7/', '7', $addresses[0]['phone'])
                : null;
        }

        $message = PreAppMessage::createFromArray($preappData);

        return $api->preApps->preApp($message)->getRedirectLink();
    }
}