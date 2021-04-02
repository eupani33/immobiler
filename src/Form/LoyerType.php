<?php

namespace App\Form;

use App\Entity\Loyer;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoyerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('type',  ChoiceType::class, ['choices' => ['Virement' => 'Virement', 'Prélevement' => 'Prélevement','Cb' => 'Cb',  'Chèque' => 'Chèque', 'Espece' => 'Espece']])
            ->add('locataire_info')
            ->add('local_info')
            ->add('montant_tot', MoneyType::class, ['required' => false])
            ->add('loyer', MoneyType::class, ['required' => false])
            ->add('charge', MoneyType::class, ['required' => false])
            ->add('caf', MoneyType::class, ['required' => false])
            ->add('periode_du', DateType::class,  ['widget' => 'single_text', 'required' => false])
            ->add('periode_au', DateType::class,  ['widget' => 'single_text', 'required' => false])
            ->add('date_paiement', DateType::class, ['widget' => 'single_text', 'required' => false])
            ->add('paiement', MoneyType::class, ['required' => false])
            ->add('paie_1', MoneyType::class, ['required' => false])
            ->add('paie_2', MoneyType::class, ['required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Loyer::class,
        ]);
    }
}
