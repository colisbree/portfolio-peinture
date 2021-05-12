<?php

namespace App\Tests;

use App\Entity\Blogpost;
use DateTime;
use PHPUnit\Framework\TestCase;

class BlogpostUnitTest extends TestCase
{
    public function testIsTrue()   // test 1 => test si la valeur passée est bien celle qui est reçue => TRUE
    {
        $blogpost = new Blogpost();
        $dateTime = new DateTime();

        $blogpost   
                -> setTitre(('titre'))
                -> setCreatedAt($dateTime)
                -> setContenu('contenu')
                -> setSlug('slug');

        $this->assertTrue($blogpost->getTitre()=== 'titre');
        $this->assertTrue($blogpost->getCreatedAt()=== $dateTime);
        $this->assertTrue($blogpost->getContenu()=== 'contenu');
        $this->assertTrue($blogpost->getSlug()=== 'slug');
    }

    public function testIsFalse()  // test 2 => test si la valeur passée est différente de celle reçue est bien FALSE
    {
        $blogpost = new Blogpost();
        $dateTime = new DateTime();

        $blogpost   
                -> setTitre(('titre'))
                -> setCreatedAt($dateTime)
                -> setContenu('contenu')
                -> setSlug('slug');

        $this->assertFalse($blogpost->getTitre()=== 'autre');
        $this->assertFalse($blogpost->getCreatedAt()=== new DateTime());
        $this->assertFalse($blogpost->getContenu()=== 'autre');
        $this->assertFalse($blogpost->getSlug()=== 'autre');
    }

    public function testIsEmpty() // test 3 => test si rien n'est passé qu'il n'y a rien en retour
    {
        $blogpost = new Blogpost();

        $this->assertEmpty($blogpost->getTitre());
        $this->assertEmpty($blogpost->getCreatedAt());
        $this->assertEmpty($blogpost->getContenu());
        $this->assertEmpty($blogpost->getSlug());
    }
}
