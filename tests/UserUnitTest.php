<?php

namespace App\Tests;

use App\Entity\Blogpost;
use App\Entity\User;
use App\Entity\Peinture;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testIsTrue()   // test 1 => test si la valeur passée est bien celle qui est reçue => TRUE
    {
        $user = new User();

        $user   -> setEmail('true@test.com')
                -> setPrenom('prenom')
                -> setNom('nom')
                -> setPassword('password')
                -> setAPropos('a propos')
                -> setInstagram('instagram')
                -> setTelephone('0123456789')
                -> setRoles(['ROLE_TEST']);

        $this->assertTrue($user->getEmail()=== 'true@test.com');
        $this->assertTrue($user->getPrenom()=== 'prenom');
        $this->assertTrue($user->getNom()=== 'nom');
        $this->assertTrue($user->getPassword()=== 'password');
        $this->assertTrue($user->getAPropos()=== 'a propos');
        $this->assertTrue($user->getInstagram()=== 'instagram');
        $this->assertTrue($user->getTelephone()=== '0123456789');
        $this->assertTrue($user->getRoles()=== ['ROLE_TEST', 'ROLE_USER']);
    }

    public function testIsFalse()  // test 2 => test si la valeur passée est différente de celle reçue est bien FALSE
    {
        $user = new User();

        $user   -> setEmail('true@test.com')
                -> setPrenom('prenom')
                -> setNom('nom')
                -> setPassword('password')
                -> setAPropos('a propos')
                -> setInstagram('instagram')
                -> setTelephone('0123456789');
                
        $this->assertFalse($user->getEmail()=== 'false@test.com');
        $this->assertFalse($user->getPrenom()=== 'false');
        $this->assertFalse($user->getNom()=== 'false');
        $this->assertFalse($user->getPassword()=== 'false');
        $this->assertFalse($user->getAPropos()=== 'false');
        $this->assertFalse($user->getInstagram()=== 'false');
        $this->assertFalse($user->getTelephone()=== '9876543210');     
    }

    public function testIsEmpty() // test 3 => test si rien n'est passé qu'il n'y a rien en retour
    {
        $user = new User();

        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getPrenom());
        $this->assertEmpty($user->getNom());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getAPropos());
        $this->assertEmpty($user->getInstagram());
        $this->assertEmpty($user->getId());
        $this->assertEmpty($user->getTelephone());
    }

    public function testAddGetRemovePeinture() // ajout suppression d'une peinture
    {
        $user = new User();
        $peinture = new Peinture();

        $this->assertEmpty($user -> getPeintures());     

        $user -> addPeinture($peinture);
        $this -> assertContains($peinture, $user -> getPeintures());  

        $user -> RemovePeinture($peinture);
        $this->assertEmpty($user -> getPeintures());     
    } 

    public function testAddGetRemoveBlogpost() // ajout suppression d'un blogpost
    {
        $user = new User();
        $blogpost = new Blogpost();

        $this->assertEmpty($user -> getBlogposts());     

        $user -> addBlogpost($blogpost);
        $this -> assertContains($blogpost, $user -> getBlogposts());  

        $user -> RemoveBlogpost($blogpost);
        $this->assertEmpty($user -> getBlogposts());     
    } 
}
