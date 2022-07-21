<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Controller;

use BnplPartners\Factoring004\Exception\PackageException;
use BnplPartners\Factoring004Prestashop\DeliveryHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends \PrestaShopBundle\Controller\Admin\Sell\Order\OrderController
{
    /**
     * @var \BnplPartners\Factoring004Prestashop\DeliveryHandler
     */
    private $deliveryHandler;

    public function __construct(DeliveryHandler $deliveryHandler)
    {
        parent::__construct();

        $this->deliveryHandler = $deliveryHandler;
    }

    public function updateStatusFromListAction(int $orderId, Request $request): RedirectResponse
    {
        try {
            $shouldConfirmOtp = $this->deliveryHandler->handle($orderId, $request->request->get('value'));
        } catch (PackageException $e) {
            $this->addFlash('error', $this->getErrorMessageForException($e, [
                PackageException::class => _PS_MODE_DEV_ ? $e->getMessage() : 'An error occurred',
            ]));

            return $this->redirectToRoute('admin_orders_index');
        }

        if ($shouldConfirmOtp) {
            return $this->redirectToRoute('admin_factoring004_otp_index');
        }

        return parent::updateStatusFromListAction($orderId, $request);
    }
}
