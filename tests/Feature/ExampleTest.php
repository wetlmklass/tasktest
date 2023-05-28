<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Тест запроса баланса
     */
    public function test_balance(): void
    {
        $response = $this->get('/api/balance/2');

        $response->assertStatus(200);
    }

    /**
     * Тест запроса статистики
     */
    public function test_transaction(): void
    {
        $response = $this->post('/api/transactions', [
            'from' => '1995-03-15 00:00:00',
            'to'   => '2000-08-07 00:00:00'
        ]);

        $response->assertStatus(200);
    }

    /**
     * Тест изменения баланса
     */
    public function test_edit_balance(): void
    {
        $response = $this->post('/api/balance', [
            "id" => 2,
            "sum" => 104554
        ]);

        $response->assertStatus(200);
    }
}
