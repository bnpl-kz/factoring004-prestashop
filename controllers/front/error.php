<?php

class Factoring004ErrorModuleFrontController extends ModuleFrontControllerCore
{
    public function postProcess(): void
    {
        $this->context->smarty->assign([
            'errorPageCss' => _MODULE_DIR_ . 'factoring004/assets/css/factoring004-errorpage.css',
        ]);
        $this->setTemplate('module:factoring004/views/templates/factoring004-errorpage.tpl');
    }
}