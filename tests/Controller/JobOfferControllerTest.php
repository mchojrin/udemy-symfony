<?php


namespace App\Tests\Controller;


class JobOfferControllerTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{
    public function testApply()
    {
        $client = static::createClient();
        $client->request('GET', '/job/offer/2/apply');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextSame('h1', 'You are applying to Second Offer edited');
        $client->submitForm('Save', [
            'application[name]' => 'John Doe',
            'application[email]' => 'john.doe@gmail.com',
            'application[birthdate]' => (new \DateTimeImmutable('today - 20 years'))->format('Y-m-d'),
        ]);
        $this->assertResponseIsSuccessful();
    }
}