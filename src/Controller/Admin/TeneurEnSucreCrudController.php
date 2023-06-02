<?php

namespace App\Controller\Admin;

use App\Entity\TeneurEnSucre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TeneurEnSucreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TeneurEnSucre::class;
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
