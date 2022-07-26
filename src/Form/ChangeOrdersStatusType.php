<?php

declare(strict_types=1);

namespace BnplPartners\Factoring004Prestashop\Form;

use ConfigurationCore;
use PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class ChangeOrdersStatusType extends \PrestaShopBundle\Form\Admin\Sell\Order\ChangeOrdersStatusType
{
    private const DISABLED_STATUSES = [
        'FACTORING004_DELIVERY_ORDER_STATUS',
        'FACTORING004_RETURN_ORDER_STATUS',
    ];

    /**
     * @var \PrestaShop\PrestaShop\Core\Form\FormChoiceProviderInterface
     */
    private $orderStatusChoiceProvider;

    public function __construct(FormChoiceProviderInterface $orderStatusChoiceProvider)
    {
        parent::__construct($orderStatusChoiceProvider);

        $this->orderStatusChoiceProvider = $orderStatusChoiceProvider;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('new_order_status_id', ChoiceType::class, [
                'choices' => $this->orderStatusChoiceProvider->getChoices(),
                'translation_domain' => false,
                'choice_attr' => $this->getDisabledStates(),
            ])
            ->add('order_ids', CollectionType::class, [
                'allow_add' => true,
                'entry_type' => HiddenType::class,
                'label' => false,
            ])
        ;

        $builder->get('order_ids')
            ->addModelTransformer(new CallbackTransformer(
                static function ($orderIds) {
                    return $orderIds;
                },
                static function (array $orderIds) {
                    return array_map(static function ($orderId) {
                        return (int) $orderId;
                    }, $orderIds);
                }
            ))
        ;
    }

    /**
     * @return array<string, array<string, bool>>
     */
    private function getDisabledStates(): array
    {
        $statuses = $this->getOrderStatuses();

        return array_map(function ($value) use ($statuses) {
            return [
                'disabled' => $disabled = in_array($value, $statuses, true),
                'title' => $disabled ? 'Disabled by factoring004' : '',
            ];
        }, $this->orderStatusChoiceProvider->getChoices());
    }

    /**
     * @return string[]
     */
    private function getOrderStatuses(): array
    {
        return array_map(function ($key) {
            return ConfigurationCore::get($key);
        }, static::DISABLED_STATUSES);
    }
}
