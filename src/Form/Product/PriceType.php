<?php

namespace App\Form\Product;

use App\Entity\Product\Price;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriceType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount')
            ->add('currency')
            ->setDataMapper($this)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'empty_data' => null,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function mapDataToForms($viewData, \Traversable $forms)
    {
        $forms = iterator_to_array($forms);
        $forms['amount']->setData($viewData ? $viewData->getAmount() : 0);
        $forms['currency']->setData($viewData ? $viewData->getCurrency() : 'EUR');
    }

    /**
     * {@inheritDoc}
     */
    public function mapFormsToData(\Traversable $forms, &$viewData)
    {
        $forms = iterator_to_array($forms);
        $viewData = new Price(
            $forms['amount']->getData(),
            $forms['currency']->getData()
        );
    }
}
