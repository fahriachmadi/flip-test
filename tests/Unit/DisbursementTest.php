<?php

namespace Tests\Unit;

use App\Disbursement;
use Tests\TestCase;

class DisbursementTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testSend()
    {
        $response = $this->postJson('/api/send', [
            'bank_code' => 'bni',
            'account_number' => '1234567890',
            'amount' => 10000,
            'remark' => 'sample remark'
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                "success"=> true,
            ]);
    }

    public function testCheck()
    {
        $find = Disbursement::all()->first();
        $response = $this->get('/api/status/'.$find->id);

        $response
            ->assertStatus(200)
            ->assertJson([
                "success"=> true,
            ]);
    }

    public function testNotFound()
    {
        $response = $this->get('/api/status/3');

        $response->assertStatus(404);
    }

}
