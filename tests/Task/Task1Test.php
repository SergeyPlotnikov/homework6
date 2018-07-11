<?php

namespace Tests\Task;

use App\Services\Currency;
use App\Services\CurrencyRepositoryInterface;
use Tests\TestCase;

/**
 * Tests Task1
 */
class Task1Test extends TestCase
{
    const ENDPOINT = '/api/currencies';

    public function test_currency_entity()
    {
        $date = new \DateTime();

        $currency = new Currency(
            1,
            'somecoin',
            'btc',
            1000,
            $date,
            true
        );

        $this->assertEquals(1, $currency->getId());
        $this->assertEquals('somecoin', $currency->getName());
        $this->assertEquals('btc', $currency->getShortName());
        $this->assertEquals(1000, $currency->getActualCourse());
        $this->assertEquals($date, $currency->getActualCourseDate());
        $this->assertEquals(true, $currency->isActive());
    }

    public function test_currency_repository_registered()
    {
        $this->assertInstanceOf(
            CurrencyRepositoryInterface::class,
            $this->app->make(
                CurrencyRepositoryInterface::class
            )
        );
    }

    public function test_currency_repository_find_all()
    {
        $repository = $this->app->make(CurrencyRepositoryInterface::class);

        $currencies = $repository->findAll();

        $this->assertNotEmpty($currencies);
        $this->assertCurrenciesData($currencies);
    }

    public function test_currency_repository_find_active()
    {
        $repository = $this->app->make(CurrencyRepositoryInterface::class);

        $currencies = $repository->findActive();

        $this->assertNotEmpty($currencies);
        
        foreach ($currencies as $currency) {
            $this->assertInstanceOf(Currency::class, $currency);
            $this->assertTrue($currency->isActive());
        }
    }

    public function test_currency_repository_find_by_id_not_found()
    {
        $repository = $this->app->make(CurrencyRepositoryInterface::class);

        $this->assertNull($repository->findById(999999));
    }

    public function test_currency_repository_save()
    {
        $repository = $this->app->make(CurrencyRepositoryInterface::class);

        $currency = new Currency(
            999,
            'somecoin',
            'btc',
            1000,
            new \DateTime(),
            true
        );

        $repository->save($currency);

        $currency = $repository->findById(999);

        $this->assertEquals(999, $currency->getId());
        $this->assertEquals('somecoin', $currency->getName());
    }

    private function assertCurrenciesData(array $currencies): void
    {
        foreach ($currencies as $currency) {
            $this->assertInstanceOf(Currency::class, $currency);
            $this->assertNotEmpty($currency->getId());
            $this->assertNotEmpty($currency->getName());
            $this->assertNotEmpty($currency->getShortName());
            $this->assertNotEmpty($currency->getActualCourse());
            $this->assertNotEmpty($currency->getActualCourseDate());
            $this->assertContains($currency->isActive(), [true, false]);
        }
    }

   public function testStatus()
   {
       $response =  $this->json('GET', self::ENDPOINT);
       $response->assertStatus(200);
   }

   public function testHeader()
   {
       $response =  $this->json('GET', self::ENDPOINT);
       $response->assertHeader('Content-Type', 'application/json');
   }

   public function testStructure()
   {
       $response =  $this->json('GET', self::ENDPOINT);
       $response->assertJsonStructure([
           [
               'id',
               'name',
               'short_name',
               'actual_course',
               'actual_course_date',
               'active'
           ]
        ]);
    
        $responseData = $response->json();

        foreach ($responseData as $item) {
            $this->assertEquals(true, $item['active']);
        }
   }
}