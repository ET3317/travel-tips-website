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
            ->add('title', TextType::class, [
                'label' => 'Title', // Set the label
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a title for your tip',
                    ]),
                ],
                'attr' => [
                    'class' => 'title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none',
                    'spellcheck' => 'false',
                    'placeholder' => 'Title',
                ],
            ])
            ->add('text', TextareaType::class, [
                'label' => 'text', // Set the label
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a text for your tip',
                    ]),
                ],
                'attr' => [
                    'class' => 'description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none',
                    'spellcheck' => 'false',
                    'placeholder' => 'Describe everything about this post here',
                ],
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => true,
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
