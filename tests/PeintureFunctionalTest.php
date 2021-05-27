<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PeintureFunctionalTest extends WebTestCase
{
    public function testShouldDisplayPeinture(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/realisations');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Dernières réalisations');
    }

    public function testShouldDisplayOnePeinture(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/realisations/peinture-test');

        $this->assertResponseIsSuccessful();
        
    }

    
}
