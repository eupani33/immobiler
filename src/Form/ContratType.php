<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\Locataire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_entree', DateType::class,  ['widget' => 'single_text', 'required' => false])
            ->add('date_sortie', DateType::class,  ['widget' => 'single_text', 'required' => false])
            ->add('date_etat_lieux', DateType::class,  ['widget' => 'single_text', 'required' => false])
            ->add('loyer', MoneyType::class, ['required' => false])
            ->add('charges', MoneyType::class, ['required' => false])
            ->add('caution', MoneyType::class, ['required' => false])
            ->add('taxes', MoneyType::class, ['required' => false])
            ->add('eau_entree')
            ->add('eau_sortie')
            ->add('actif')
            ->add('locataire')
            ->add('local');
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
