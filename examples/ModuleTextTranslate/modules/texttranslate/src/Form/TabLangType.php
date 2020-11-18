<?php

namespace PrestaShop\Module\TextTranslate\Form;

use PrestaShopBundle\Entity\Lang;
use PrestaShopBundle\Entity\Tab;
use PrestaShopBundle\Entity\TabLang;
// use PrestaShop\Module\TextTranslate\Entity\TabLang;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        $tab = isset($options['data']) ? $options['data']->getId() : null;
        $builder
            ->add('id_t', HiddenType::class, [
                'mapped' => false,
                'data' => $tab ? $tab->getId() : 0
            ])
            ->add('name', TextType::class, [
                'attr' => [
                ],
                'label' => 'Name'
            ])
            ->add('lang', EntityType::class, [
                'class' => Lang::class,
                'choice_label' => 'name',
                'label' => 'Language',
                'attr' => [],
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-warning'
                ],
                'label' => 'Save'
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