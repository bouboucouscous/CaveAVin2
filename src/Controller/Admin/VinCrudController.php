<?php

namespace App\Controller\Admin;


use App\Entity\Vin;
use App\Entity\Robe;
use App\Entity\TeneurEnSucre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class VinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vin::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        $anneesDisponibles = range(date('Y')-100,date('Y'));
        return [
            TextField::new('nom'),
            TextField::new('formatCl'),
            AssociationField::new('robe'),
            AssociationField::new('TeneurEnSucre'),

            ChoiceField::new('Annee')
                ->setLabel('Année')
                ->setChoices(array_combine($anneesDisponibles, $anneesDisponibles))
        ];
    }
    
}
