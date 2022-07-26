<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Controller;

use BnplPartners\Factoring004\Exception\ErrorResponseException;
use BnplPartners\Factoring004\Exception\PackageException;
use OrderCore;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends \PrestaShopBundle\Controller\Admin\Sell\Order\OrderController
{
    /**
     * @var \BnplPartners\Factoring004Prestashop\Handler\OrderStatusHandlerInterface[]
     */
    private $orderStatusHandlers;

    /**
     * @param \BnplPartners\Factoring004Prestashop\Handler\OrderStatusHandlerInterface[] $orderStatusHandlers
     */
    public function __construct(array $orderStatusHandlers)
    {
        parent::__construct();

        $this->orderStatusHandlers = $orderStatusHandlers;
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

    public function partialRefundAction(int $orderId, Request $request): RedirectResponse
    {
        $data = $request->request->get('cancel_product', []);
        $amount = 0;

        foreach ($data as $key => $value) {
            if (preg_match('/^amount_\d+$/i', $key) === 1) {
                $amount += (float) $value;
            }
        }

        return $this->updateOrderStatusConditionally(
            $request,
            $orderId,
            'partial_refund',
            function () use ($request, $orderId) {
                return parent::partialRefundAction($orderId, $request);
            },
            function () use ($orderId) {
                return $this->redirectToRoute('admin_orders_view', [
                    'orderId' => $orderId,
                ]);
            },
            $amount
        );
    }

    /**
     * @param callable(): RedirectResponse $updater
     * @param callable(): RedirectResponse $previous
     * @param int|float|null $amount
     */
    private function updateOrderStatusConditionally(
        Request $request,
        int $orderId,
        string $orderStatusId,
        callable $updater,
        callable $previous,
        $amount = null
    ): RedirectResponse {
        $order = new OrderCore($orderId);

        if ($order->module !== 'factoring004') {
            return $updater();
        }

        foreach ($this->orderStatusHandlers as $orderStatusHandler) {
            if (!$orderStatusHandler->shouldProcess($orderStatusId)) {
                continue;
            }

            if ($request->getSession()->has('_factoring004_' . $orderStatusHandler->getKey() . '_otp_checked')) {
                $request->getSession()->remove('_factoring004_' . $orderStatusHandler->getKey() . '_otp_checked');
                $request->getSession()->remove('_factoring004_' . $orderStatusHandler->getKey() . '_forward_data');

                return $updater();
            }

            try {
                $shouldConfirmOtp = $orderStatusHandler->handle($order, $amount);
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
                $request->getSession()->set('_factoring004_' . $orderStatusHandler->getKey() . '_forward_data', [
                    'data' => $request->request->all(),
                    'controller' => $request->attributes->get('_controller'),
                ]);

                return $this->redirectToRoute('admin_factoring004_otp_index', [
                    'type' => $orderStatusHandler->getKey(),
                    'order_id' => $orderId,
                ]);
            }
        }

        return $updater();
    }
}
