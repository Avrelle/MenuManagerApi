<?php

namespace App\Controller\Admin;

use App\Entity\Table;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TableCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Table::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnform(),
            IntegerField::new('numero'),
        ];
    }
    
}