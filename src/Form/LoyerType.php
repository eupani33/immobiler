<?php

namespace App\Form;

use App\Entity\Local;
use App\Entity\Loyer;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoyerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['label' => 'Descriptif',])
            ->add('locataire_info', TextType::class, ['label' => 'Locataire',])
            ->add('types', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'label' => 'Type',
            ])


            ->add('local', EntityType::class, [
                'class' => Local::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'label' => 'Local',
            ])
            ->add('montant_tot', MoneyType::class, ['required' => false])
            ->add('loyer', MoneyType::class, ['required' => false])
            ->add('charge', MoneyType::class, ['required' => false])
            ->add('caf', MoneyType::class, ['required' => false])
            ->add('periode_du', DateType::class,  ['widget' => 'single_text', 'required' => false])
            ->add('periode_au', DateType::class,  ['widget' => 'single_text', 'required' => false])
            ->add('date_paiement', DateType::class, [
                'widget' => 'single_text',
                // 'mapped' => false,
                'required' => false,
                // 'empty_data'  => '',
            ])
            ->add('paiement', MoneyType::class, ['required' => false])
            ->add('paie_1', MoneyType::class, ['label' => 'relicat', 'required' => false])
            ->add('paie_2', MoneyType::class, ['required' => false]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Loyer::class,
        ]);
    }
}
