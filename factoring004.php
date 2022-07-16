<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Factoring004 extends PaymentModule
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
        DB::getInstance()->execute(
            'CREATE TABLE IF NOT EXISTS `'. _DB_PREFIX_ .'factoring004_order_preapps` (
              `id` int(11) NOT NULL,
              `order_id` int(11) NOT NULL,
              `preapp_uid` varchar(255) NOT NULL,
              `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                PRIMARY KEY(`id`),
                UNIQUE(`order_id`,`preapp_uid`)
            ) ENGINE=InnoDB;'
        );
        return parent::install();
    }

    public function uninstall()
    {
        DB::getInstance()->execute(
            'DROP TABLE IF EXISTS `'. _DB_PREFIX_ .'factoring004_order_preapps`;'
        );
        return parent::uninstall();
    }
}