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
use Symfony\Component\Validator\Constraints\NotBlank;

class TranslationAddType extends AbstractType
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
                'attr' => [
                    'class' => 'search-word-place',
                    'placeholder' => 'example : Cat'
                ],
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'Key word'
            ])
            ->add('translation', TextType::class, [
                'attr' => [
                    'class' => 'search-word-place',
                    'placeholder' => 'example : Cat say Maaaw'
                ],
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'Translation'
            ])
            ->add('domain', TextType::class, [
                'attr' => [
                    'class' => 'search-word-place',
                    'placeholder' => 'example : Admin.Cat.Say'
                ],
                'label' => 'Domain',
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('theme', TextType::class, [
                'attr' => [
                    'class' => 'search-word-place',
                    'placeholder' => '(Optional) example : classic'
                ],
                'label' => 'Theme'
            ])
            ->add('lang', EntityType::class, [
                'class' => Lang::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'select-lang'
                ],
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary tab_new_trans_save'
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