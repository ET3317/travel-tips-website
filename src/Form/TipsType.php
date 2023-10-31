<?php

namespace App\Form;

use App\Entity\Tips;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TipsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [ // Utilisez TextType pour le champ 'text'
                'constraints' => [ // Ajoutez une contrainte de validation
                    new NotBlank([
                        'message' => 'Please enter a title for your tip', // Message à afficher en cas de validation échouée
                    ]),
                ],
            ])
            ->add('text', TextareaType::class, [ // Utilisez TextType pour le champ 'text'
                'constraints' => [ // Ajoutez une contrainte de validation
                    new NotBlank([
                        'message' => 'Please enter a text for your tip', // Message à afficher en cas de validation échouée
                    ]),
                ],
            ])
            ->add('user', HiddenType::class, [
                'data' => $options['user'], // Cette option doit être passée lors de la création du formulaire
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => true, // Pour permettre la soumission de formulaires sans image
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tips::class,
            'user' => null, // Cette option permet de passer l'utilisateur courant au formulaire
        ]);
    }
}
