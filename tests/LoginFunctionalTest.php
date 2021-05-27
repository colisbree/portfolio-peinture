<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

// test fonctionnel de SecurityController.php
class LoginFunctionalTest extends WebTestCase
{
    public function testShouldDisplayLoginPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Ouvrir une session');
    }

    public function testVisitingWhileLoggedIn(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $buttonCrawlerNode =$crawler -> selectButton('Ouvrir une session'); // cherche le bouton ouvrir une session
        $form = $buttonCrawlerNode -> form();       // récupération du formualaire associé au bouton

        // passage des paramètres aux champs du formulaire
        $form = $buttonCrawlerNode -> form([
            'email' => 'user@test.com',
            'password' => 'password',
        ]);

        $client -> submit($form);                   // soumission du formulaire
        $crawler = $client -> request('GET', '/login'); // retour sur la page login et on vérifie que l'on est connecté

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('div', 'You are logged in as user@test.com');
    }
}
