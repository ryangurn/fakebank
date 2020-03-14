<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BankTest extends TestCase
{
    use RefreshDatabase;

    public function testBankIndexPage(){

        $user = factory(User::class)->create();

        $this->followingRedirects();
        $response = $this->actingAs($user)->get(route('bank.index'));
        $response->assertStatus(200);
        $response->assertSee('Bank');
    }

    public function testBankCreatePage(){

        $user = factory(User::class)->create();

        $this->followingRedirects();
        $response = $this->actingAs($user)->get(route('bank.create'));
        $response->assertStatus(200);
        $response->assertSee('Create Bank');
        $response->assertSee('Bank Name');
        $response->assertSee('Bank Caption');
        $response->assertSee('Trolls to enable, this must be in JSON form.');
    }

    public function testBankCreateForm(){

        $user = factory(User::class)->create();

        $this->followingRedirects();
        $data = ['bank' => 'Fakebank', 'caption' => 'The fakest of them all', 'trolls' => ''];
        $response = $this->actingAs($user)->post(route('bank.store'), $data);
        $response->assertStatus(200);

    }
}
