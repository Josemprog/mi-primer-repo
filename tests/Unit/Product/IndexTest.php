<?php

namespace Tests\Feature\Product;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_products()
    {
        //$this->withoutExceptionHandling();
        //Arrange
        $user = factory(User::class)->create();

        $products = factory(Product::class, 5)->create();
        
        //Act
        $response = $this->actingAs($user)
        ->get(route('products.index'));

        // $var = $response->getOriginalContent()['products'];

        //Assert
        $response->assertOk()
        ->assertViewIs('admin.products.index')
        ->assertViewHas('products');

    }

    
}