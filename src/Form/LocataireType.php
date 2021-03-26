<?php

namespace App\Form;

use App\Entity\Locataire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LocataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite',  ChoiceType::class, ['choices' => ['Mr' => 'Mr', 'Mme' => 'Mme', 'Melle' => 'Melle', 'Mr & Mme' => 'Mr & Mme']])
            ->add('nom', TextType::class, ['required' => false])
            ->add('prenom', TextType::class, ['required' => false])
            ->add('adresse', TextType::class, ['required' => false])
            ->add('ville', TextType::class, ['required' => false])
            ->add('cp', TextType::class, ['required' => false])
            ->add('email', TextType::class, ['required' => false])
            ->add('tel', TextType::class, ['required' => false])
            ->add('date_naissance', DateType::class,  ['widget' => 'single_text', 'required' => false])
            ->add('lieux_naissance', TextType::class, ['required' => false])
            ->add('actif');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Locataire::class,
        ]);
    }
}
