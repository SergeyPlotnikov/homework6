<?php

namespace Tests\Task;

use Tests\TestCase;

/**
 * Tests Task2
 */
class Task2Test extends TestCase
{
    const ENDPOINT = '/api/currencies';

    public function testStatus()
    {
        $response =  $this->json('GET', self::ENDPOINT . '/1');
        $response->assertStatus(200);
    }

    public function testHeader()
    {
        $response =  $this->json('GET', self::ENDPOINT . '/1');
        $response->assertHeader('Content-Type', 'application/json');
    }

    public function testContent()
    {
        $response =  $this->json('GET', self::ENDPOINT . '/1');
        $response->assertJsonStructure([
            'id',
            'name',
            'short_name',
            'actual_course',
            'actual_course_date',
            'active'
        ]);
    }

    public function testNotExistingId()
    {
        $response =  $this->json('GET', self::ENDPOINT . '/99999999');
        $response->assertStatus(404);
    }
}