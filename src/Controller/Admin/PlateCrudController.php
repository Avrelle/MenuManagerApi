<?php

namespace App\Controller\Admin;

use App\Entity\Plate;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PlateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plate::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnform(),
            AssociationField::new('categorie'),
            TextField::new('name'),
            IntegerField::new('price'),
            TextEditorField::new('description')

        ];
    }
    
}