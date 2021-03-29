<?php

namespace App\Form;

use App\Entity\Local;
use App\Entity\Locataire;
use App\Entity\Loyer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoyerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('charges_info')
            ->add('montant_tot')
            ->add('loyer')
            ->add('charge')
            ->add('caf')
            ->add('status')
            ->add('periode_du')
            ->add('periode_au')
            ->add('paiement')
            ->add('charges_info')
            ->add('paie_1')
            ->add('paie_2')
            ->add('contrat');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Loyer::class,
        ]);
    }
}
