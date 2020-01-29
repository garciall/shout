<?php


namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShoutControllerTest extends WebTestCase
{
    public function testShoutExistingAuthor()
    {
        $client = static::createClient();

        $client->request('GET', '/shout/steve-jobs?limit=1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShoutTooMany()
    {
        $client = static::createClient();

        $client->request('GET', '/shout/steve-jobs?limit=11');

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function testShoutMultipleQuotes()
    {
        $client = static::createClient();

        $client->request('GET', '/shout/steve-jobs?limit=2');
        $data = json_decode($client->getResponse()->getContent());

        $this->assertEquals(2, count($data));
    }

}