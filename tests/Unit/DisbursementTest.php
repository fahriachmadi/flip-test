<?php

namespace Tests\Unit;

use Tests\TestCase;

class DisbursementTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testForm()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testSend()
    {
        $response = $this->postJson('/send-disbursement', [
            'bank_code' => 'bni',
            'account_number' => '1234567890',
            'amount' => 10000,
            'remark' => 'sample remark'
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testCheck()
    {
        $response = $this->get('/check-status');

        $response->assertStatus(200);
    }
}
