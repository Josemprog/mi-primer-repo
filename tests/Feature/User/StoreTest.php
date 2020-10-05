<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function ItCannotCreateUserWithWrongData()
    {
        //Arrange
        $user = factory(User::class)->create();

        //Act
        $response = $this->actingAs($user)->post(route('users.store'), [
            'name' => 'jose',
            'email' => 'asd',
            'password' => 'admin'
        ]);

        //Asserts
        $response->assertSessionHasErrors('email');
    }
}
