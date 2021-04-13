<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Charge;
use App\Entity\Fournisseur;
use App\Entity\Local;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChargeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class)
            ->add('montant', MoneyType::class)
            ->add('date_paiement', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('acompte', MoneyType::class, ['required' => false])
            ->add('date_acompte', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('recurrente', CheckboxType::class, ['required' => false])
            ->add('periodicite', ChoiceType::class, ['choices' => [' ' => 'vide', 'Mensuel' => 'Mensuel', 'Trimestriel' => 'Trimestriel', 'Annuel' => 'Annuel']])
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'choice_label' => 'nom',
                'multiple' => false
            ])
            ->add('local', EntityType::class, [
                'class' => Local::class,
                'choice_label' => 'nom',
                'multiple' => false
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'categorie',
                'multiple' => false
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'nom',
                'multiple' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Charge::class,
        ]);
    }
}
