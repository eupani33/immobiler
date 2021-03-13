<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Ecriture;
use App\Entity\Local;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EcritureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class)
            ->add('type', TextType::class)
            ->add('libelle', TextType::class)
            ->add('montant', MoneyType::class)
            ->add('pointage')
            ->add('local', EntityType::class, [
                'class' => Local::class,
                'choice_label' => 'nom',
                'multiple' => false
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'categorie',
                'multiple' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ecriture::class,
        ]);
    }
}
