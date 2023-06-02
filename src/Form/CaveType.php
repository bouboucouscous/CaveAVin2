<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Entity\Cave;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Security\Core\Security;

use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

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
            ->add('utilistaeur_id', EntityType::class, [
                'class' => Utilisateur::class,
                'data' => $user,
            ])
            ->add('id_vin', null, [
                'label' => 'Vin',
            ])
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'app_cave_new',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cave::class,
        ]);
    }
}
