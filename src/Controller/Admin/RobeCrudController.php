<?php

namespace App\Controller\Admin;

use App\Entity\Robe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RobeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Robe::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
