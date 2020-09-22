<?php

namespace PrestaShop\Module\TextTranslate\Form;

use PrestaShop\Module\TextTranslate\Entity\TabLangCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TabLangCollectionType extends AbstractType
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
            ->add('tablangs', CollectionType::class, [
                'entry_type'    => TabLangType::class,
                'entry_options' => ['label' => false],
            ])
            ->add('translations', CollectionType::class, [
                'entry_type'    => TranslationType::class,
                'entry_options' => ['label' => false],
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-warning btn-lg'
                ],
                'label' => 'Save changes'
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TabLangCollection::class,
        ]);
    }
}