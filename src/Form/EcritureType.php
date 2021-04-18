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
            ->add(
                'mois',
                ChoiceType::class,
                array(
                    'required' => false,
                    'mapped' => false,
                    'choices' => $this->buildMonthChoices(),
                    'choice_attr' => function ($choice, $key, $value) {
                        return ['class' => 'attending_' . strtolower($key)];
                    },
                )
            )
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'categorie',
                'multiple' => false
            ]);
    }

    public function buildMonthChoices()
    {
        $arrayMonth = array();
        for ($i = 1; $i <= 12; $i++) {
            $date = new \DateTime();
            $date->setDate(1900, $i, 01);
            $arrayMonth[$i] = $date->format('F');
        }
        return $arrayMonth;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ecriture::class,
        ]);
    }
}
