<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Adapter\LegacyLogger;
use PrestaShop\PrestaShop\Adapter\Order\CommandHandler\UpdateOrderStatusHandler;
use PrestaShop\PrestaShop\Adapter\SymfonyContainer;

class Factoring004 extends PaymentModuleCore
{

    public function __construct()
    {
        $this->name                   = 'factoring004';
        $this->tab                    = 'payments_gateways';
        $this->version                = '1.0';
        $this->author                 = 'BNPL Team';
        $this->controllers            = array('payment', 'validation');
        $this->currencies             = true;
        $this->currencies_mode        = 'checkbox';
        $this->bootstrap              = true;
        $this->displayName            = 'Рассрочка 0-0-4';
        $this->description            = 'Купи сейчас, плати потом! Быстрое и удобное оформление рассрочки на 4 месяца без первоначальной оплаты. Моментальное подтверждение, без комиссий и процентов. Для заказов суммой от 6000 до 200000 тг.';
        $this->confirmUninstall       = 'Вы действительно хотите удалить платежный модуль Рассрочка 0-0-4?';
        $this->ps_versions_compliancy = array('min' => '1.7.8', 'max' => _PS_VERSION_);

        parent::__construct();
    }

    public function install()
    {
        $this->addOrderState();
        ConfigurationCore::updateValue('PS_OS_FACTORING004', DbCore::getInstance()->query(
            'SELECT * FROM `'. _DB_PREFIX_ .'order_state` WHERE `module_name` = '."'$this->name'".';'
        )->fetch()['id_order_state']);
        return parent::install()
            && $this->registerHook('paymentOptions')
            && $this->registerHook('actionFrontControllerInitAfter');
    }

    public function uninstall()
    {
        $this->deleteOrderState();
        return ConfigurationCore::deleteByName('PS_OS_FACTORING004')
            && ConfigurationCore::deleteByName('FACTORING004_API_HOST')
            && ConfigurationCore::deleteByName('FACTORING004_OAUTH_LOGIN')
            && ConfigurationCore::deleteByName('FACTORING004_OAUTH_PASSWORD')
            && ConfigurationCore::deleteByName('FACTORING004_PARTNER_NAME')
            && ConfigurationCore::deleteByName('FACTORING004_PARTNER_CODE')
            && ConfigurationCore::deleteByName('FACTORING004_POINT_CODE')
            && ConfigurationCore::deleteByName('FACTORING004_DELIVERY_METHODS')
            && ConfigurationCore::deleteByName('FACTORING004_OFFER_FILE_NAME')
            && ConfigurationCore::deleteByName('FACTORING004_CLIENT_ROUTE')
            && parent::uninstall();
    }

    public function getContent(): string
    {
        if (ToolsCore::isSubmit('btnSubmit')) {
            ConfigurationCore::updateValue('FACTORING004_API_HOST', ToolsCore::getValue('FACTORING004_API_HOST'));
            ConfigurationCore::updateValue('FACTORING004_OAUTH_LOGIN', ToolsCore::getValue('FACTORING004_OAUTH_LOGIN'));
            ConfigurationCore::updateValue('FACTORING004_OAUTH_PASSWORD', ToolsCore::getValue('FACTORING004_OAUTH_PASSWORD'));
            ConfigurationCore::updateValue('FACTORING004_PARTNER_NAME', ToolsCore::getValue('FACTORING004_PARTNER_NAME'));
            ConfigurationCore::updateValue('FACTORING004_PARTNER_CODE', ToolsCore::getValue('FACTORING004_PARTNER_CODE'));
            ConfigurationCore::updateValue('FACTORING004_POINT_CODE', ToolsCore::getValue('FACTORING004_POINT_CODE'));
            ConfigurationCore::updateValue('FACTORING004_DELIVERY_METHODS',  implode(',',ToolsCore::getValue('FACTORING004_DELIVERY_METHODS') ?: []));
            ConfigurationCore::updateValue('FACTORING004_OFFER_FILE_NAME', ToolsCore::getValue('FACTORING004_OFFER_FILE_NAME'));
            ConfigurationCore::updateValue('FACTORING004_PAID_ORDER_STATUS', ToolsCore::getValue('FACTORING004_PAID_ORDER_STATUS'));
            ConfigurationCore::updateValue('FACTORING004_DECLINED_ORDER_STATUS', ToolsCore::getValue('FACTORING004_DECLINED_ORDER_STATUS'));
            ConfigurationCore::updateValue('FACTORING004_DELIVERY_ORDER_STATUS', ToolsCore::getValue('FACTORING004_DELIVERY_ORDER_STATUS'));
            ConfigurationCore::updateValue('FACTORING004_RETURN_ORDER_STATUS', ToolsCore::getValue('FACTORING004_RETURN_ORDER_STATUS'));
            ConfigurationCore::updateValue('FACTORING004_CANCEL_ORDER_STATUS', ToolsCore::getValue('FACTORING004_CANCEL_ORDER_STATUS'));
            ConfigurationCore::updateValue('FACTORING004_CLIENT_ROUTE', ToolsCore::getValue('FACTORING004_CLIENT_ROUTE'));
            ToolsCore::redirect($_SERVER['HTTP_REFERER']);
        }

        $formAction = $this->context->link->getAdminLink('AdminModules') .
            '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $this->smarty->assign([
            'statuses' => OrderStateCore::getOrderStates($this->context->language->id),
            'file_upload' => $this->generateControllerURI('file_upload'),
            'file_destroy' => $this->generateControllerURI('file_destroy'),
            'configuration_value' => $this->getConfigurationValues(),
            'delivery_methods' => CarrierCore::getCarriers($this->context->language->id, true, 0, ZoneCore::getIdByName('Asia')),
            'action' => $formAction,
        ]);

        return $this->fetch('module:factoring004/views/templates/admin/configuration.tpl');
    }

    public function hookPaymentOptions($params)
    {
        if (!$this->active) {
            return;
        }

        $formAction = $this->context->link->getModuleLink($this->name, 'validation', array(), true);
        $totalPrice = $this->context->cart->getOrderTotal();
        $offerFileName = ConfigurationCore::get('FACTORING004_OFFER_FILE_NAME');

        $this->smarty->assign([
            'action' => $formAction,
            'totalPrice' => $totalPrice,
            'offerFileName' => $offerFileName,
            'paymentScheduleCss' => _MODULE_DIR_ . 'factoring004/assets/css/factoring004-paymentschedule.css',
            'paymentScheduleJs' => _MODULE_DIR_ . 'factoring004/assets/js/factoring004-paymentschedule.js',
        ]);

        $paymentForm = $this->fetch('module:factoring004/views/templates/hook/payment_options.tpl');

        $newOption = new PrestaShop\PrestaShop\Core\Payment\PaymentOption;
        $newOption->setModuleName($this->displayName)
            ->setCallToActionText($this->displayName)
            ->setAction($formAction)
            ->setForm($paymentForm);
        $payment_options = array(
            $newOption
        );

        return $payment_options;
    }

    /**
     * @param array<string, mixed> $params
     */
    public function hookActionFrontControllerInitAfter(array $params): void
    {
        /** @var \ModuleFrontControllerCore $controller */
        $controller = $params['controller'];

        if (!$controller instanceof Factoring004PostLinkModuleFrontController) {
            return;
        }

        ContextCore::getContext()->employee = new EmployeeCore();

        $controller->setLogger(new LegacyLogger());
        $controller->setUpdateStatusHandler(new UpdateOrderStatusHandler());
    }

    private function getConfigurationValues(): array
    {
        return [
            'factoring004_api_host' => ToolsCore::getValue('FACTORING004_API_HOST', ConfigurationCore::get('FACTORING004_API_HOST')),
            'factoring004_oauth_login' => ToolsCore::getValue('FACTORING004_OAUTH_LOGIN', ConfigurationCore::get('FACTORING004_OAUTH_LOGIN')),
            'factoring004_oauth_password' => ToolsCore::getValue('FACTORING004_OAUTH_PASSWORD', ConfigurationCore::get('FACTORING004_OAUTH_PASSWORD')),
            'factoring004_partner_name' => ToolsCore::getValue('FACTORING004_PARTNER_NAME', ConfigurationCore::get('FACTORING004_PARTNER_NAME')),
            'factoring004_partner_code' => ToolsCore::getValue('FACTORING004_PARTNER_CODE', ConfigurationCore::get('FACTORING004_PARTNER_CODE')),
            'factoring004_point_code' => ToolsCore::getValue('FACTORING004_POINT_CODE', ConfigurationCore::get('FACTORING004_POINT_CODE')),
            'factoring004_delivery_methods' => ToolsCore::getValue('FACTORING004_DELIVERY_METHODS', explode(',',ConfigurationCore::get('FACTORING004_DELIVERY_METHODS') ?: '')),
            'factoring004_offer_file' => ToolsCore::getValue('FACTORING004_OFFER_FILE_NAME', ConfigurationCore::get('FACTORING004_OFFER_FILE_NAME')),
            'factoring004_paid_order_status' => ToolsCore::getValue('FACTORING004_PAID_ORDER_STATUS', ConfigurationCore::get('FACTORING004_PAID_ORDER_STATUS')),
            'factoring004_declined_order_status' => ToolsCore::getValue('FACTORING004_DECLINED_ORDER_STATUS', ConfigurationCore::get('FACTORING004_DECLINED_ORDER_STATUS')),
            'factoring004_delivery_order_status' => ToolsCore::getValue('FACTORING004_DELIVERY_ORDER_STATUS', ConfigurationCore::get('FACTORING004_DELIVERY_ORDER_STATUS')),
            'factoring004_return_order_status' => ToolsCore::getValue('FACTORING004_RETURN_ORDER_STATUS', ConfigurationCore::get('FACTORING004_RETURN_ORDER_STATUS')),
            'factoring004_cancel_order_status' => ToolsCore::getValue('FACTORING004_CANCEL_ORDER_STATUS', ConfigurationCore::get('FACTORING004_CANCEL_ORDER_STATUS')),
            'factoring004_client_route' => ToolsCore::getValue('FACTORING004_CLIENT_ROUTE', ConfigurationCore::get('FACTORING004_CLIENT_ROUTE')),
        ];
    }

    private function generateControllerURI($name): string
    {
        /**
         * @var \Symfony\Component\Routing\Router $router
         */
        $router = SymfonyContainer::getInstance()->get('router');
        return $router->generate($name);
    }

    private function addOrderState(): void
    {
        $order_state = new OrderStateCore();
        $order_state->color = '#34209E';
        $order_state->send_email = false;
        $order_state->module_name = $this->name;
        $order_state->template = $this->name;
        $order_state->name = array();
        $languages = LanguageCore::getLanguages(false);
        foreach ($languages as $language) {
            if ($language['iso_code'] === 'ru') {
                $order_state->name[$language['id_lang']] = 'Ожидается оплата Рассрочка 0-0-4';
            } else {
                $order_state->name[$language['id_lang']] = 'Awaiting Factoring 0-0-4 payment';
            }
        }

        $order_state->add();
    }

    private function deleteOrderState(): void
    {
        DbCore::getInstance()->execute(
            'DELETE FROM `'. _DB_PREFIX_ .'order_state` WHERE `module_name` = '."'$this->name'".';'
        );
        DbCore::getInstance()->execute(
            'DELETE FROM `'. _DB_PREFIX_ .'order_state_lang` WHERE `template` = '."'$this->name'".';'
        );
    }
}