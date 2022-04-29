<?php

namespace App\Form;

use App\Entity\Church;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ChurchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent mb-5 block border-b-2 w-full h-12 text-2xl', 
                    'placeholder' => 'Enter church name...'
                ),
                // 'label' => false,
                'required' => false
            ])
            ->add('website', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent mb-5 block border-b-2 w-full h-12 text-2xl', 
                    'placeholder' => 'Enter church website...'
                ),
                // 'label' => false,
                'required' => false
            ])
            ->add('address', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-12 text-2xl', 
                    'placeholder' => 'Enter church address...'
                ),
                // 'label' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Church::class,
        ]);
    }
}
