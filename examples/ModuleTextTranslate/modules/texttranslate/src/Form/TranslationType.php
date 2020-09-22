<?php

namespace PrestaShop\Module\TextTranslate\Form;

use PrestaShopBundle\Entity\Lang;
use PrestaShopBundle\Entity\Translation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
/**
 * TranslationType class
 */
class TranslationType extends AbstractType
{
    /**
     * Undocumented function
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('key', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'search-word-place'
                ]
            ])
            ->add('translation', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'search-word-place'
                ]
            ])
            ->add('domain', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'search-word-place'
                ]
            ])
            ->add('theme', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'search-word-place'
                ],
                'required' => false
            ])
            ->add('lang', EntityType::class, [
                'class' => Lang::class,
                'choice_label' => 'name',
                'label' => false,
                'attr' => [
                    'class' => 'select-lang'
                ]
            ])
        ;

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Translation::class,
        ]);
    }
}