<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PretControllerTest extends WebTestCase
{
    public function testPret()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pret');
    }

}
