<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeFunctionalTest extends WebTestCase
{
    // Ce test fonctionnel vérifie que la page se charge en cherchant le texte de la balise H1
    public function testShouldDisplayHomePage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Rubens Moliere');
        // si on veut être certain du chargement, on peut aussi vérifier qu'il y a la phrase
        $this->assertSelectorTextContains('p', 'Artiste peintre à Grenoble');
    }
}
