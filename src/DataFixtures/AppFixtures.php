<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Blogpost;
use App\Entity\Peinture;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @codeCoverageIgnore
 */
class AppFixtures extends Fixture
{
    private $encoder; // pour le mot de passe

    public function __construct(UserPasswordEncoderInterface $encoder) // toujours pour le mdp
    {
        $this -> encoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        // Utilisation de Faker
        $faker = Factory::create('fr_FR');
        
        //création d'un utilisateur
        $user = new User();

        $user   -> setEmail('user@test.com')
                -> setPrenom($faker -> firstname())
                -> setNom($faker -> lastname())
                -> setTelephone($faker -> phoneNumber())
                -> setAPropos($faker -> text())
                -> setInstagram('instagram')
                -> setRoles(['ROLE_PEINTRE']);
                
        $password = $this->encoder->encodePassword($user, 'password'); //le mdp ici est : password
        $user   -> setPassword($password);

        $manager -> persist($user);

        //création de 10 blogpost
        for ($i=0; $i<10; $i++) {
            $blogpost = new Blogpost();

            $blogpost
                -> setTitre($faker -> words(3, true))
                -> setCreatedAt($faker -> dateTimeBetween('-6 month', 'now'))
                -> setContenu($faker ->text(350))
                -> setSlug($faker -> slug(3))
                -> setUser($user);

            $manager -> persist($blogpost);
        }

        // création d'un blogpost pour test fonctionnel
        $blogpost = new Blogpost();

        $blogpost
                -> setTitre('Blogpost test')
                -> setCreatedAt($faker -> dateTimeBetween('-6 month', 'now'))
                -> setContenu($faker ->text(350))
                -> setSlug('blogpost-test')
                -> setUser($user);

        $manager -> persist($blogpost);

        //création de 5 catégories
        for ($k=0; $k<5; $k++) {
            $categorie = new Categorie();

            $categorie
                -> setNom($faker -> word())
                -> setDescription($faker -> word(10, true))
                -> setSlug($faker -> slug());
            
            $manager -> persist($categorie);

            //création de 2 peintures par catégories
            for ($j=0; $j<2; $j++) {
                $peinture = new Peinture();

                $peinture
                        -> setNom($faker -> words(3, true))
                        -> setLargeur($faker -> randomFloat(2, 20, 60))
                        -> setHauteur($faker -> randomFloat(2, 20, 60))
                        -> setEnVente($faker -> randomElement([true, false]))
                        -> setDateRealisation($faker -> dateTimeBetween('-6 month', 'now'))
                        -> setCreatedAt($faker -> dateTimeBetween('-6 month', 'now'))
                        -> setDescription($faker -> text())
                        -> setPortfolio($faker -> randomElement([true, false]))
                        -> setSlug($faker -> slug())
                        -> setFile('placeholder.jpg')
                        -> addCategorie($categorie)
                        -> setPrix($faker -> randomFloat(2, 100, 9999))
                        -> setUser($user);

                $manager -> persist($peinture);
            }
        }

        // categorie de test fonctionnel
        $categorie = new Categorie();

        $categorie
            -> setNom('Categorie test')
            -> setDescription($faker -> word(10, true))
            -> setSlug('categorie-test');
        
        $manager -> persist($categorie);

        // peinture de test fonctionnel
        $peinture = new Peinture();

        $peinture
                -> setNom('Peinture test')
                -> setLargeur($faker -> randomFloat(2, 20, 60))
                -> setHauteur($faker -> randomFloat(2, 20, 60))
                -> setEnVente($faker -> randomElement([true, false]))
                -> setDateRealisation($faker -> dateTimeBetween('-6 month', 'now'))
                -> setCreatedAt($faker -> dateTimeBetween('-6 month', 'now'))
                -> setDescription($faker -> text())
                -> setPortfolio($faker -> randomElement([true, false]))
                -> setSlug('peinture-test')
                -> setFile('placeholder.jpg')
                -> addCategorie($categorie)
                -> setPrix($faker -> randomFloat(2, 100, 9999))
                -> setUser($user);

        $manager -> persist($peinture);

        $manager->flush(); // insère les données en BDD
    }
}
