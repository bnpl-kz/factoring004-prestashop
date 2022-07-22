<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Controller;

use BnplPartners\Factoring004\Exception\ErrorResponseException;
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

        return $this->updateOrderStatusConditionally(
            $request,
            $orderId,
            $orderStatusId,
            function () use ($request, $orderId) {
                return parent::updateStatusAction($orderId, $request);
            },
            function () use ($orderId) {
                return $this->redirectToRoute('admin_orders_view', [
                    'orderId' => $orderId,
                ]);
            }
        );
    }

    public function updateStatusFromListAction(int $orderId, Request $request): RedirectResponse
    {
        return $this->updateOrderStatusConditionally(
            $request,
            $orderId,
            $request->request->get('value'),
            function () use ($request, $orderId) {
                return parent::updateStatusFromListAction($orderId, $request);
            },
            function () {
                return $this->redirectToRoute('admin_orders_index');
            }
        );
    }

    /**
     * @param callable(): RedirectResponse $updater
     * @param callable(): RedirectResponse $previous
     */
    private function updateOrderStatusConditionally(
        Request $request,
        int $orderId,
        string $orderStatusId,
        callable $updater,
        callable $previous
    ): RedirectResponse {
        if ($request->getSession()->has('_factoring004_delivery_otp_checked')) {
            $request->getSession()->remove('_factoring004_delivery_otp_checked');
            $request->getSession()->remove('_factoring004_delivery_forward_data');

            return $updater();
        }

        try {
            $shouldConfirmOtp = $this->deliveryHandler->handle($orderId, $orderStatusId);
        } catch (PackageException $e) {
            if ($e instanceof ErrorResponseException) {
                $message = $e->getErrorResponse()->getMessage();
            } else {
                $message = _PS_MODE_DEV_ ? $e->getMessage() : 'An error occurred';
            }

            $this->addFlash('error', $this->getErrorMessageForException($e, [
                ErrorResponseException::class => $message,
                PackageException::class => _PS_MODE_DEV_ ? $e->getMessage() : 'An error occurred',
            ]));

            return $previous();
        }

        if ($shouldConfirmOtp) {
            $request->getSession()->set('_factoring004_delivery_forward_data', [
                'data' => $request->request->all(),
                'controller' => $request->attributes->get('_controller'),
            ]);

            return $this->redirectToRoute('admin_factoring004_otp_index', [
                'type' => 'delivery',
                'order_id' => $orderId,
            ]);
        }

        return $updater();
    }
}
