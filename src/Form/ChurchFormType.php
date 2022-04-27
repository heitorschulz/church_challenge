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
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl', 
                    'placeholder' => 'Enter church name...'
                ),
                'label' => false
            ])
            ->add('website', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block mt-10 border-b-2 w-full h-20 text-6xl', 
                    'placeholder' => 'Enter church website...'
                ),
                'label' => false
            ])
            ->add('address', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block  mt-10 border-b-2 w-full h-20 text-6xl', 
                    'placeholder' => 'Enter church address...'
                ),
                'label' => false
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
