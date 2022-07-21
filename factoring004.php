<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

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

    public function install(): bool
    {
        DbCore::getInstance()->execute(
            'CREATE TABLE IF NOT EXISTS `'. _DB_PREFIX_ .'factoring004_order_preapps` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `order_id` int(11) NOT NULL,
              `preapp_uid` varchar(255) NOT NULL,
              `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                PRIMARY KEY(`id`),
                UNIQUE(`order_id`,`preapp_uid`)
            ) ENGINE=InnoDB;'
        );
        return parent::install();
    }

    public function uninstall(): bool
    {
        DbCore::getInstance()->execute(
            'DROP TABLE IF EXISTS `'. _DB_PREFIX_ .'factoring004_order_preapps`;'
        );
        return ConfigurationCore::deleteByName('FACTORING004_API_HOST')
        && ConfigurationCore::deleteByName('FACTORING004_PA_TOKEN')
        && ConfigurationCore::deleteByName('FACTORING004_AS_TOKEN')
        && ConfigurationCore::deleteByName('FACTORING004_PARTNER_NAME')
        && ConfigurationCore::deleteByName('FACTORING004_PARTNER_CODE')
        && ConfigurationCore::deleteByName('FACTORING004_POINT_CODE')
        && ConfigurationCore::deleteByName('FACTORING004_PARTNER_EMAIL')
        && ConfigurationCore::deleteByName('FACTORING004_PARTNER_WEBSITE')
        && ConfigurationCore::deleteByName('FACTORING004_DELIVERY_METHODS')
        && ConfigurationCore::deleteByName('FACTORING004_OFFER_FILE_NAME')
        && parent::uninstall();
    }

    public function getContent(): string
    {
        if (ToolsCore::isSubmit('btnSubmit')) {
            ConfigurationCore::updateValue('FACTORING004_API_HOST', ToolsCore::getValue('FACTORING004_API_HOST'));
            ConfigurationCore::updateValue('FACTORING004_PA_TOKEN', ToolsCore::getValue('FACTORING004_PA_TOKEN'));
            ConfigurationCore::updateValue('FACTORING004_AS_TOKEN', ToolsCore::getValue('FACTORING004_AS_TOKEN'));
            ConfigurationCore::updateValue('FACTORING004_PARTNER_NAME', ToolsCore::getValue('FACTORING004_PARTNER_NAME'));
            ConfigurationCore::updateValue('FACTORING004_PARTNER_CODE', ToolsCore::getValue('FACTORING004_PARTNER_CODE'));
            ConfigurationCore::updateValue('FACTORING004_POINT_CODE', ToolsCore::getValue('FACTORING004_POINT_CODE'));
            ConfigurationCore::updateValue('FACTORING004_PARTNER_EMAIL', ToolsCore::getValue('FACTORING004_PARTNER_EMAIL'));
            ConfigurationCore::updateValue('FACTORING004_PARTNER_WEBSITE', ToolsCore::getValue('FACTORING004_PARTNER_WEBSITE'));
            ConfigurationCore::updateValue('FACTORING004_DELIVERY_METHODS',  implode(',',ToolsCore::getValue('FACTORING004_DELIVERY_METHODS') ?: []));
            ConfigurationCore::updateValue('FACTORING004_OFFER_FILE_NAME', ToolsCore::getValue('FACTORING004_OFFER_FILE_NAME'));
        }

        $formAction = $this->context->link->getAdminLink('AdminModules') .
            '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $this->smarty->assign([
            'file_upload' => $this->generateControllerURI('file_upload'),
            'file_destroy' => $this->generateControllerURI('file_destroy'),
            'configuration_value' => $this->getConfigurationValues(),
            'delivery_methods' => CarrierCore::getCarriers($this->context->language->id, true, 0, ZoneCore::getIdByName('Asia')),
            'action' => $formAction,
        ]);

        return $this->fetch('module:factoring004/views/templates/admin/configuration.tpl');
    }

    private function getConfigurationValues(): array
    {
        return [
            'factoring004_api_host' => ToolsCore::getValue('FACTORING004_API_HOST', ConfigurationCore::get('FACTORING004_API_HOST')),
            'factoring004_pa_token' => ToolsCore::getValue('FACTORING004_PA_TOKEN', ConfigurationCore::get('FACTORING004_PA_TOKEN')),
            'factoring004_as_token' => ToolsCore::getValue('FACTORING004_AS_TOKEN', ConfigurationCore::get('FACTORING004_AS_TOKEN')),
            'factoring004_partner_name' => ToolsCore::getValue('FACTORING004_PARTNER_NAME', ConfigurationCore::get('FACTORING004_PARTNER_NAME')),
            'factoring004_partner_code' => ToolsCore::getValue('FACTORING004_PARTNER_CODE', ConfigurationCore::get('FACTORING004_PARTNER_CODE')),
            'factoring004_point_code' => ToolsCore::getValue('FACTORING004_POINT_CODE', ConfigurationCore::get('FACTORING004_POINT_CODE')),
            'factoring004_partner_email' => ToolsCore::getValue('FACTORING004_PARTNER_EMAIL', ConfigurationCore::get('FACTORING004_PARTNER_EMAIL')),
            'factoring004_partner_website' => ToolsCore::getValue('FACTORING004_PARTNER_WEBSITE', ConfigurationCore::get('FACTORING004_PARTNER_WEBSITE')),
            'factoring004_delivery_methods' => ToolsCore::getValue('FACTORING004_DELIVERY_METHODS', explode(',',ConfigurationCore::get('FACTORING004_DELIVERY_METHODS') ?: '')),
            'factoring004_offer_file' => ToolsCore::getValue('FACTORING004_OFFER_FILE_NAME', ConfigurationCore::get('FACTORING004_OFFER_FILE_NAME')),
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
}