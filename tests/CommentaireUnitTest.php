<?php

namespace App\Tests;

use DateTime;
use App\Entity\Blogpost;
use App\Entity\Peinture;
use App\Entity\Commentaire;
use PHPUnit\Framework\TestCase;

class CommentaireUnitTest extends TestCase
{
    public function testIsTrue()   // test 1 => test si la valeur passée est bien celle qui est reçue => TRUE
    {
        $commentaire = new Commentaire();
        $dateTime = new DateTime();
        $blogpost = new Blogpost();
        $peinture = new Peinture();

        $commentaire   
                -> setAuteur('auteur')
                -> setEmail('test@email.com')
                -> setContenu('contenu')
                -> setCreatedAt($dateTime)
                -> setBlogpost($blogpost)
                -> setPeinture($peinture);

        $this->assertTrue($commentaire->getAuteur()=== 'auteur');
        $this->assertTrue($commentaire->getEmail()=== 'test@email.com');
        $this->assertTrue($commentaire->getContenu()=== 'contenu');
        $this->assertTrue($commentaire->getCreatedAt()=== $dateTime);
        $this->assertTrue($commentaire->getBlogpost()=== $blogpost);
        $this->assertTrue($commentaire->getPeinture()=== $peinture);
    }

    public function testIsFalse()  // test 2 => test si la valeur passée est différente de celle reçue est bien FALSE
    {
        $commentaire = new Commentaire();
        $dateTime = new DateTime();
        $blogpost = new Blogpost();
        $peinture = new Peinture();

        $commentaire   
                -> setAuteur('auteur')
                -> setEmail('test@email.com')
                -> setContenu('contenu')
                -> setCreatedAt($dateTime)
                -> setBlogpost($blogpost)
                -> setPeinture($peinture);

        $this->assertFalse($commentaire->getAuteur()=== 'false');
        $this->assertFalse($commentaire->getEmail()=== 'false@email.com');
        $this->assertFalse($commentaire->getContenu()=== 'false');
        $this->assertFalse($commentaire->getCreatedAt()=== new DateTime());
        $this->assertFalse($commentaire->getBlogpost()=== new Blogpost());
        $this->assertFalse($commentaire->getPeinture()=== new Peinture());
    }

    public function testIsEmpty() // test 3 => test si rien n'est passé qu'il n'y a rien en retour
    {
        $commentaire = new Commentaire();

        $this->assertEmpty($commentaire->getAuteur());
        $this->assertEmpty($commentaire->getEmail());
        $this->assertEmpty($commentaire->getContenu());
        $this->assertEmpty($commentaire->getCreatedAt());
        $this->assertEmpty($commentaire->getBlogpost());
        $this->assertEmpty($commentaire->getPeinture());
        $this->assertEmpty($commentaire->getId());
    }
}
