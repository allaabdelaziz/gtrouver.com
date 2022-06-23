<?php

namespace App\Controller\Admin;

use App\Entity\SubCategories;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SubCategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SubCategories::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            BooleanField::new('lost','perdu'),
            AssociationField::new('Users')->autocomplete(),
             AssociationField::new('categories')->autocomplete(),
            
             AssociationField::new('categoriesdetails','details')
             ->autocomplete(''),
             
            TextField::new('objectname'),
            TextField::new('lost_address'),
            TextField::new('owner_secondname'),
            TextField::new('object_description'),
            TextField::new('object_clues'),
            ImageField::new('imageobject','photo')
            ->setBasePath('uploads/object')
            ->setUploadDir('public/uploads/object')
            ->setFormType(FileUploadType::class)
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(true)
            
 
            
        ];
    }
    
}
