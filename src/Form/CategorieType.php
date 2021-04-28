<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Categorie;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('classe', EntityType::class, [
                'class'=> Classe::class,
                'choice_label' => 'nom',
])
            ->add('categorie')
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
                $classe = $event->getData();
                $form = $event->getForm();

             if (!$classe) {
                return; 
             }

            if (isset($classe['categorie']) && $classe['categorie']) {    
                $form->add('categorie');
            } else {
                        unset($classe['categorie']);
                        $event->setData($classe);
                    }
            })
        ->getForm();       
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
