<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'error_bubbling' => true,
                'attr' => [
                    'autofocus'   => 1,
                    'placeholder' => 'Create your product title',
                    'class'       => 'form-control'
                ]
            ])
            ->add('price', NumberType::class, [
                'label' => false,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'Set your product price',
                    'class'       => 'form-control'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'error_bubbling' => true,
                'attr' => [
                    'placeholder' => 'Tell your customer about your product (e.g. dimension, color, size, etc).',
                    'class'       => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
