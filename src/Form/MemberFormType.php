<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class MemberFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl', 
                    'placeholder' => 'Enter member name...'
                ),
                'label' => false,
                'required' => false
            ])
            ->add('CPF', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl', 
                    'placeholder' => 'Enter member CPF...'
                ),
                'label' => false,
                'required' => false
            ])
            ->add('birthday', DateTimeType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-2xl', 
                    'placeholder' => 'Enter member birthday ...'
                ),
                'label' => false,
                'required' => false
            ])
            ->add('email', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl', 
                    'placeholder' => 'Enter member e-mail...'
                ),
                'label' => false,
                'required' => false
            ])
            ->add('telephone', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl', 
                    'placeholder' => 'Enter member telephone...'
                ),
                'label' => false,
                'required' => false
            ])
            ->add('address', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl', 
                    'placeholder' => 'Enter member address...'
                ),
                'label' => false,
                'required' => false
            ])
            ->add('city', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl', 
                    'placeholder' => 'Enter member city...'
                ),
                'label' => false,
                'required' => false
            ])
            ->add('state', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block border-b-2 w-full h-20 text-6xl', 
                    'placeholder' => 'Enter member state...'
                ),
                'label' => false,
                'required' => false
            ])
            // ->add('church')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
