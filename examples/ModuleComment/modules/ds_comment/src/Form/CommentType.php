<?php

namespace PrestaShop\Module\DSComment\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['required' => true])
            ->add('description', TextareaType::class, ['required' => true])
            ->add('rating', RangeType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 5
                ],
                'mapped' => false
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Add comment',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }
}