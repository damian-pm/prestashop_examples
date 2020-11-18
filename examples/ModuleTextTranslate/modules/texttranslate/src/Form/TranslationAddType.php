<?php

namespace PrestaShop\Module\TextTranslate\Form;

use PrestaShopBundle\Entity\Lang;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
// use PrestaShop\Module\TextTranslate\Entity\Translation;
use PrestaShopBundle\Entity\Translation;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

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
            ->add('id', HiddenType::class, [
                'mapped' => false,
                'data' => isset($options['data']) ? $options['data']->getId() : 0
            ])
            ->add('key', TextType::class, [
                'attr' => [
                    'class' => 'search-word-place',
                    'placeholder' => 'example : Contact'
                ],
                'help' => "example in template:  {l s='Contact' d='Admin.Navigation.Footer'}",
                'constraints' => [
                    new NotBlank(),
                ],
                'label' => 'Key word'
            ])
            ->add('translation', TextType::class, [
                'attr' => [
                    'class' => 'search-word-place',
                    'placeholder' => 'example : Contact - we translate'
                ],
                'constraints' => [
                    new NotBlank(),
                ],
                // 'data' => '',
                'label' => 'Translation'
            ])
            ->add('domain', TextType::class, [
                'attr' => [
                    'class' => 'search-word-place',
                    'placeholder' => 'example : AdminContactSay'
                ],
                'help' => "example in template:  {l s='Contact' d='Admin.Contact.Say'}",
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
                'required' => false,
                'label' => 'Theme'
            ])
            ->add('lang', EntityType::class, [
                'class' => Lang::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'select-lang'
                ],
                'help' => 'What language should translate Key',
                'label' => 'Language'
            ])
            ->add('update', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
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