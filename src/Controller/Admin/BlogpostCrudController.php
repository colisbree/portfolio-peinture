<?php

namespace App\Controller\Admin;

use App\Entity\Blogpost;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BlogpostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blogpost::class;
    }

    // les modifications ci-apres permettent la modification de l'affichage 
    // c'est la configuration des champs dans la page index et dans le formulaire
    public function configureFields(string $pageName): iterable
    {
        return [
            /*
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
            */
            TextField::new('titre'),
            TextField::new('slug')->hideOnForm(), // permet de voir le slug dans la page index mais pas dans page détail du formulaire
            TextareaField::new('contenu'),
            DateField::new('createdAt')->hideOnForm(),
        ];
    }
    
    // permet de trier sur une colonne => ici on choisit la date de création du post 
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            -> setDefaultSort(['createdAt' => 'DESC']);
    }
}
