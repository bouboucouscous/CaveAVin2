<?php

namespace App\Form;

use App\Entity\Cave;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Security\Core\Security;


class CaveType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser();

        $builder
            ->add('enter_date', null, [
                'label' => 'Date d\'entrée',
            ])
            ->add('exit_date', null, [
                'label' => 'Date de sortie',
            ])
            ->add('utilisateur_id', HiddenType::class, [
                'mapped' => false,
                'data' => $user->getId(),
            ])
            ->add('id_vin', null, [
                'label' => 'Vin',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cave::class,
        ]);
    }
}
