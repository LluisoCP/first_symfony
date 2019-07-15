<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType as SymfonyTextType;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Marque', SymfonyTextType::class, [
                'help'          => 'Obligatoire, minimum 3 caractères',
                'constraints'   => [
                    new Length([
                        'min'           => 3,
                        'minMessage'    => 'Message d\'erreur de VoitureType (Form): La marque doit contenir au moins trois caractères.',
                    ]),
                ],
            ])
            ->add('Modele', SymfonyTextType::class, [
                'help'          => 'Obligatoire, minimum 2 caractères',
                'constraints'   => [
                    new Length([
                        'min'           => 2,
                        'minMessage'    => 'Le modèle doit contenir au moins deux caractères.',
                    ]),
                ],
            ])
            ->add('Immatriculation', SymfonyTextType::class, [
                'help'          => 'Obligatoire, minimum 4 caractères',
                'constraints'   => [
                    new Length([
                        'min'           => 4,
                        'minMessage'    => 'L\'immatriculation doit contenit au moins quatre caractères.',
                    ]),
                ],
            ])
            ->add('Couleur', SymfonyTextType::class, [
                'help'          => 'Obligatoire, minimum 3 caractères',
                'constraints'   => [
                    new Length([
                        'min'           => 3,
                        'minMessage'    => 'La couleur doit contenir au moins trois caratères.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
