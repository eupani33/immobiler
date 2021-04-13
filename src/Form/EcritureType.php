<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Ecriture;
use App\Entity\Local;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Extra\Intl\IntlExtension;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Test\FormInterface;

class EcritureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class,  ['widget' => 'single_text',])
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

        $formModifier = function (FormInterface $form, $mois) {
            $form->add('mois', ChoiceType::class, [
                'choices' => [
                    '01' => '01',
                    '02' => '02',
                    '03' => '03',
                    '04' => '04',
                    '05' => '05',
                    '06' => '06',
                    '07' => '07',
                    '08' => '08',
                    '09' => '09',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12',
                ], 'placeholder' => '',
                'choices' => $mois,
                'required' => false
            ]);
        };
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) {

            $data = $event->getData();
            $formModifier($event->getForm(), $data->getMois());
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ecriture::class,
        ]);
    }
}
