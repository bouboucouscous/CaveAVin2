<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;


class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('plainPassword', PasswordType::class, [
                'required' => false,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit faire minimum 8 caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new NotCompromisedPassword([
                        'message' => 'Le mot de passe est compromis dans des bases public'
                    ]),
                    new Regex([
                        'pattern' => '/\+/i',
                        'message' => 'Le mot de passe doit contenir au moins un chiffre',
                    ]),
                    new Regex([
                        'pattern' => '/[#?!@$%^&*-]+/i',
                        'message' => 'Le mot de passe doit contenir au moins un des caractères suivant: /[#?!@$%^&*-]',
                    ]),
                    new Regex([
                        'pattern' => '/[a-z]/',
                        'message' => 'Votre mot de passe doit contenir au moins un caractère miniscule',
                    ]),
                    new Regex([
                        'pattern' => '/[A-Z]/',
                        'message' => 'Votre mot de passe doit contenir au moins un caractère majuscule',
                    ]),
                ],
            ])
            ->add('nom')
            ->add('prenom')
            ->add('nbPlaceBouteillle', IntegerType::class, [
                'constraints' => [
                    new NotNull(['message' => 'Ce champ ne peut pas être vide.']),
                    new GreaterThan(['value' => 0, 'message' => 'Le nombre doit être supérieur à zéro.'])
                ],
            ])
            ->add('email', TextType::class,[
                'label' => 'Adresse mail',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
