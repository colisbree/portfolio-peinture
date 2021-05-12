<?php

namespace App\Tests;

use App\Entity\Categorie;
use PHPUnit\Framework\TestCase;

class CategorieUnitTest extends TestCase
{
    public function testIsTrue()   // test 1 => test si la valeur passée est bien celle qui est reçue => TRUE
    {
        $categorie = new Categorie();

        $categorie   
                -> setNom('nom')
                -> setDescription('description')
                -> setSlug('slug');

        $this->assertTrue($categorie->getNom()=== 'nom');
        $this->assertTrue($categorie->getDescription()=== 'description');
        $this->assertTrue($categorie->getSlug()=== 'slug');
    }

    public function testIsFalse()  // test 2 => test si la valeur passée est différente de celle reçue est bien FALSE
    {
        $categorie = new Categorie();

        $categorie   
                -> setNom('nom')
                -> setDescription('description')
                -> setSlug('slug');

        $this->assertFalse($categorie->getNom()=== 'false');
        $this->assertFalse($categorie->getDescription()=== 'false');
        $this->assertFalse($categorie->getSlug()=== 'false');
    }

    public function testIsEmpty() // test 3 => test si rien n'est passé qu'il n'y a rien en retour
    {
        $categorie = new Categorie();

        $this->assertEmpty($categorie->getNom());
        $this->assertEmpty($categorie->getDescription());
        $this->assertEmpty($categorie->getSlug());
    }
}
