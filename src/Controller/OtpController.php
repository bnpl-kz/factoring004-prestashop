<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Controller;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use PrestaShopBundle\Security\Annotation\AdminSecurity;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OtpController extends FrameworkBundleAdminController
{
    private const OTP_LENGTH = 4;

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

        if ($form->isSubmitted() && $form->isValid()) {
            // Check OTP and update order status
        }

        return $this->render('@Modules/factoring004/views/otp.html.twig', [
            'form' => $form->createView(),
            'layoutTitle' => 'Check OTP'
        ]);
    }
}
