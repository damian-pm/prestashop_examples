<?php

namespace PrestaShop\Module\TextTranslate\Form;

use PrestaShopBundle\Entity\Lang;
use PrestaShopBundle\Entity\TabLang;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
/**
 * TabLangType class
 */
class TabLangType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'search-word-place'
                ]
            ])
            ->add('lang', EntityType::class, [
                'class' => Lang::class,
                'choice_label' => 'name',
                'label' => false,
                'attr' => [
                    'class' => 'select-lang'
                ],
            ])
        ;

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TabLang::class,
        ]);
    }
}