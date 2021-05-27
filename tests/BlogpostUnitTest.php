<?php

namespace App\Tests;

use DateTime;
use App\Entity\User;
use App\Entity\Blogpost;
use App\Entity\Commentaire;
use PHPUnit\Framework\TestCase;

class BlogpostUnitTest extends TestCase
{
    public function testIsTrue()   // test 1 => test si la valeur passée est bien celle qui est reçue => TRUE
    {
        $blogpost = new Blogpost();
        $dateTime = new DateTime();
        $user = new User();

        $blogpost   
                -> setTitre(('titre'))
                -> setCreatedAt($dateTime)
                -> setContenu('contenu')
                -> setSlug('slug')
                -> setUser($user);

        $this->assertTrue($blogpost->getTitre()=== 'titre');
        $this->assertTrue($blogpost->getCreatedAt()=== $dateTime);
        $this->assertTrue($blogpost->getContenu()=== 'contenu');
        $this->assertTrue($blogpost->getSlug()=== 'slug');
        $this->assertTrue($blogpost->getUser()=== $user);
    }

    public function testIsFalse()  // test 2 => test si la valeur passée est différente de celle reçue est bien FALSE
    {
        $blogpost = new Blogpost();
        $dateTime = new DateTime();
        $user = new User();

        $blogpost   
                -> setTitre(('titre'))
                -> setCreatedAt($dateTime)
                -> setContenu('contenu')
                -> setSlug('slug')
                -> setUser($user);

        $this->assertFalse($blogpost->getTitre()=== 'autre');
        $this->assertFalse($blogpost->getCreatedAt()=== new DateTime());
        $this->assertFalse($blogpost->getContenu()=== 'autre');
        $this->assertFalse($blogpost->getSlug()=== 'autre');
        $this->assertFalse($blogpost->getUser()=== new User());
    }

    public function testIsEmpty() // test 3 => test si rien n'est passé qu'il n'y a rien en retour
    {
        $blogpost = new Blogpost();

        $this->assertEmpty($blogpost->getTitre());
        $this->assertEmpty($blogpost->getCreatedAt());
        $this->assertEmpty($blogpost->getContenu());
        $this->assertEmpty($blogpost->getSlug());
        $this->assertEmpty($blogpost->getId());
    }
    
    /*
        Ajout tests après codage du front 
    */

    public function testAddGetRemoveCommentaire()
    {
        $blogpost = new Blogpost();
        $commentaire = new Commentaire();

        $this->assertEmpty($blogpost -> getCommentaires());     // verifie que le getCommentaire est vide

        $blogpost -> addCommentaire($commentaire);
        $this -> assertContains($commentaire, $blogpost -> getCommentaires());  // vérifie qu'on récupère bien le commentaire

        $blogpost -> RemoveCommentaire($commentaire);
        $this->assertEmpty($blogpost -> getCommentaires());     // vérifie que le getCommentaire est de nouveau vide
    }
}
