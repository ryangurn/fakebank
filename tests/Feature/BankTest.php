<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BankTest extends TestCase
{
    use RefreshDatabase;

    public function testBankIndex(){

        $user = factory(User::class)->create();

        $this->followingRedirects();
        $response = $this->actingAs($user)->get(route('bank.index'));
        $response->assertStatus(200);
        $response->assertSee('Bank');
    }
}
