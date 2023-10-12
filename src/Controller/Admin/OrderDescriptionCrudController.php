<?php

namespace App\Controller\Admin;

use App\Entity\OrderDescription;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderDescriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderDescription::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('order_desc'),
            TextEditorField::new('comment'),
            CollectionField::new('choice'),
            DateField::new('createdAt')
        ];
    }
    
}