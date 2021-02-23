<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PhoneNumberControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function showPhoneNumberListWithoutFiltersSelected()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals($crawler->filter('select[name=valid] option:selected')->attr('value'), '');
        $this->assertEquals($crawler->filter('select[name=country] option:selected')->attr('value'), '');
    }
    
    /**
     * @test
     */
    public function showSelectedFilters()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $form = $crawler->filter('#filter')->form();

                // set some values
        $form['country'] = 'Morocco';
        $form['valid'] = '';

        // submit the form
        $crawler = $client->submit($form);

        $this->assertEquals($crawler->filter('select[name=country] option:selected')->attr('value'), 'Morocco');
        $this->assertEquals($crawler->filter('select[name=valid] option:selected')->attr('value'), '');
    }
}
