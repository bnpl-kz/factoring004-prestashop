<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Controller;

use BnplPartners\Factoring004\Exception\ErrorResponseException;
use BnplPartners\Factoring004\Exception\PackageException;
use BnplPartners\Factoring004Prestashop\Otp\OtpCheckerInterface;
use OrderCore;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use PrestaShopBundle\Security\Annotation\AdminSecurity;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class OtpController extends FrameworkBundleAdminController
{
    private const OTP_LENGTH = 4;

    /**
     * @var \BnplPartners\Factoring004Prestashop\Otp\OtpCheckerInterface
     */
    private $otpChecker;

    public function __construct(OtpCheckerInterface $otpChecker)
    {
        parent::__construct();

        $this->otpChecker = $otpChecker;
    }

    /**
     * @AdminSecurity("is_granted('read', request.get('_legacy_controller'))")
     */
    public function index(Request $request, string $type): Response
    {
        $form = $this->createFormBuilder()
            ->setMethod('POST')
            ->add('otp', TextType::class, [
                'required' => true,
                'attr' => [
                    'minlength' => static::OTP_LENGTH,
                    'maxlength' => static::OTP_LENGTH,
                    'pattern' => '^\d{' . static::OTP_LENGTH . '}$',
                    'autofocus' => true,
                ],
            ])
            ->add('check', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()){
            return $this->render('@Modules/factoring004/views/otp.html.twig', [
                'form' => $form->createView(),
                'layoutTitle' => 'Check OTP',
            ]);
        }

        $data = $request->getSession()->get('_factoring004_' . $type . '_forward_data', []);

        if (!$data) {
            $form->addError(
                new FormError('Session expired. Please back to previous page and update order status again.')
            );

            return $this->render('@Modules/factoring004/views/otp.html.twig', [
                'form' => $form->createView(),
                'layoutTitle' => 'Check OTP',
            ]);
        }

        $order = new OrderCore($request->query->get('order_id'));

        try {
            $this->otpChecker->check(
                (string) $order->id,
                (int) ceil($order->total_paid),
                $form->get('otp')->getData()
            );

            $request->getSession()->set('_factoring004_' . $type . '_otp_checked', true);

            return $this->forwardToController($request, $data, $order->id);
        } catch (PackageException $e) {
            if ($e instanceof ErrorResponseException) {
                $form->addError(new FormError($e->getErrorResponse()->getMessage()));
            } else {
                $form->addError(new FormError(_PS_MODE_DEV_ ? $e->getMessage() : 'An error occurred'));
            }

            return $this->render('@Modules/factoring004/views/otp.html.twig', [
                'form' => $form->createView(),
                'layoutTitle' => 'Check OTP',
            ]);
        }
    }

    /**
     * @param array<string, mixed> $data
     */
    private function forwardToController(Request $request, array $data, int $orderId): Response
    {
        $subRequest = $request->duplicate([], $data['data'], [
            'orderId' => $orderId,
            '_controller' => $data['controller'],
        ]);

        return $this->container->get('http_kernel')->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
    }
}
