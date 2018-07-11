<?php

namespace Tests\Task;

use Tests\TestCase;

/**
 * Tests Task3
 */
class Task3Test extends TestCase
{

    const ENDPOINT = '/api/admin/currencies';

    public function testIndex()
    {
        $response =  $this->json('GET', self::ENDPOINT);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function testShow()
    {
        $response =  $this->json('GET', self::ENDPOINT . '/2');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertJsonStructure([
            'id',
            'name',
            'short_name',
            'actual_course',
            'actual_course_date',
            'active'
        ]);
    }

    public function testShowNotExistingId()
    {
        $response =  $this->json('GET', self::ENDPOINT . '/99999999');
        $response->assertStatus(404);
    }

    public function testStore()
    {
        $storeData = [
            'name' => 'BINARY',
            'short_name' => 'BNR',
            'actual_course' => 1000.00,
            'actual_course_date' => date('Y-m-d H-i-s'),
            'active' => true
        ];

        $response =  $this->json('POST', self::ENDPOINT, $storeData);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertJsonFragment($storeData);
    }

    public function testUpdate()
    {
        $storeData = [
            'actual_course' => 10001.01,
            'actual_course_date' => date('Y-m-d H-i-s')
        ];

        $response =  $this->json('PATCH', self::ENDPOINT . '/1', $storeData);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');

        $response->assertJsonFragment($storeData);
    }

    public function testUpdateNotExistingId()
    {
        $storeData = [
            'actual_course' => 10001.01,
            'actual_course_date' => date('Y-m-d H-i-s')
        ];

        $response =  $this->json('PATCH', self::ENDPOINT . '/99999999', $storeData);
        $response->assertStatus(404);
    }

    public function testDestroy()
    {
        $response =  $this->json('DELETE', self::ENDPOINT . '/1');
        $response->assertStatus(200);
    }

    public function testDestroyNotExistingId()
    {
        $response =  $this->json('DELETE', self::ENDPOINT . '/99999999');
        $response->assertStatus(404);
    }
}