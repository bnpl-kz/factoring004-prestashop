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

    public function updateStatusAction(int $orderId, Request $request): RedirectResponse
    {
        $orderStatusId = $request->request->get(
            'update_order_status_action_bar',
            $request->request->get('update_order_status', [])
        )['new_order_status_id'];

        try {
            $shouldConfirmOtp = $this->deliveryHandler->handle($orderId, $orderStatusId);
        } catch (PackageException $e) {
            $this->addFlash('error', $this->getErrorMessageForException($e, [
                PackageException::class => _PS_MODE_DEV_ ? $e->getMessage() : 'An error occurred',
            ]));

            return $this->redirectToRoute('admin_orders_view', [
                'orderId' => $orderId,
            ]);
        }

        if ($shouldConfirmOtp) {
            return $this->redirectToRoute('admin_factoring004_otp_index');
        }

        return parent::updateStatusAction($orderId, $request);
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
