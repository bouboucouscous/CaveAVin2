<?php

namespace App\Form;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Vin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

class VinType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $anneesDisponibles = range(date('Y') - 100, date('Y'));
        $anneesChoices = array_combine($anneesDisponibles, $anneesDisponibles);        
        
        $builder
            ->add('Nom')
            ->add('Annee', ChoiceType::class, [
                'choices'  => $anneesChoices])
            ->add('formatCl',TextType::class)
            ->add('robe')
            ->add('TeneurEnSucre')
            ->add('captcha', Recaptcha3Type::class, [
                'constraints' => new Recaptcha3(),
                'action_name' => 'app_vin_new',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vin::class,
        ]);
    }
}
