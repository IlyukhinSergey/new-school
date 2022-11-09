<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    use WithoutMiddleware;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testBooks()
    {
        $response = $this->get('/books');

        $response->assertSee('Books');
    }

}
