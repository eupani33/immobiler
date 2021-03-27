<?php

namespace App\Form;

use App\Entity\Local;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['label' => 'Référence'])
            ->add('adresse')
            ->add('ville')
            ->add('cp', TextType::class, ['label' => 'Code Postal'])
            ->add('compteur_edf', TextType::class, ['label' => 'Cpt Electrique', 'required' => false])
            ->add('internet', TextType::class, ['label' => 'Identifiant Internet', 'required' => false])
            ->add('eau', TextType::class, ['label' => 'Cpt Eau', 'required' => false])
            ->add('gaz', TextType::class, ['label' => 'Cpt Gaz', 'required' => false])
            ->add('surface', TextType::class, ['label' => 'Surface Habitale']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Local::class,
        ]);
    }
}
