<?php

namespace StudentBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testTeamList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertContains('Test Étudiants', $client->getResponse()->getContent());
    }
    
    public function testTeamHeroes()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/projet/1');

        $this->assertContains('Villains', $client->getResponse()->getContent());
    }
    
    public function testConnexion()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        
        $link = $crawler
            ->filter('a:contains("Se connecter")')
            ->eq(0)
            ->link()
        ;

        $crawler = $client->click($link);
        
        $this->assertContains('Connexion', $client->getResponse()->getContent());
        
        $link = $crawler
            ->filter('a:contains("Créer un compte")')
            ->eq(0)
            ->link()
        ;

        $crawler = $client->click($link);
        
        $this->assertContains('Inscription', $client->getResponse()->getContent());
    }
}
