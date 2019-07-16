<?php

namespace App\Form;

use App\Entity\Conducteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Voiture;

class ConducteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom')
            ->add('nom')
            ->add('description')
            ->add('email')
            ->add('age', NumberType::class, [
                'help'          => 'Age du conducteur.',
                'constraints'   => [
                    new GreaterThan([
                        'value'     => 17,
                        'message'   => 'Les conducteurs doivent être majeurs.'

                    ]),
                ],
            ])
            // ->add('createdAt')
            ->add('voiture', EntityType::class, [
                'class'         => Voiture::class,
                'choice_label'  => 'Immatriculation',
                'placeholder'   => 'A ce conducteur une voiture?',
                'required'    => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Conducteur::class,
        ]);
    }
}
