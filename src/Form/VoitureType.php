<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\TextType as SymfonyTextType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
                        'minMessage'    => 'Message d\'erreur de VoitureType (Form): La marque doit avoir au moins trois caractères.',
                    ]),
                ],
            ])
            ->add('Modele', SymfonyTextType::class, [
                'help'          => 'Obligatoire, minimum 2 caractères',
                'constraints'   => [
                    new Length([
                        'min'           => 2,
                        'minMessage'    => 'Le modèle doit avoir au moins deux caractères.',
                    ]),
                ],
            ])
            ->add('Immatriculation', SymfonyTextType::class, [
                'help'          => 'Obligatoire, minimum 4 caractères',
                'constraints'   => [
                    new Length([
                        'min'           => 4,
                        'minMessage'    => 'L\'immatriculation doit avoir au moins quatre caractères.',
                    ]),
                ],
            ])
            ->add('Couleur', SymfonyTextType::class, [
                'help'          => 'Obligatoire, minimum 3 caractères',
                'constraints'   => [
                    new Length([
                        'min'           => 3,
                        'minMessage'    => 'La couleur doit avoir au moins trois caratères.',
                    ]),
                ],
            ])
            ->add('image', FileType::class, [
                'label' => 'Image de la voiture.',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // everytime you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                // 'constraints' => [
                //     new File([
                //         'maxSize' => '2048k',
                //         'mimeTypes' => [
                //             'image/jpg',
                //             'image/png',
                //             'image/gif'
                //         ],
                //         'mimeTypesMessage' => 'Formats acceptés: jpg, jpeg, png, gif.',
                //     ])
                // ]
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
