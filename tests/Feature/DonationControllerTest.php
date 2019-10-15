<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DonationControllerTest extends TestCase
{
    public function test_can_store_donation()
    {
        $response = $this->post('/home',[
            'phone_number' => '+256789092843',
            'amount' => 100,
        ]);

        $response->assertStatus(201);
    }
}
