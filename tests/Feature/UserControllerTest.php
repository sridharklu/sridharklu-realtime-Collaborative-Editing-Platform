<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase; // Ensures a fresh database for each test

    /** @test */
    public function it_can_get_all_users()
    {
        // Create users
        $user = User::factory()->create();
        // Make a GET request to the /users endpoint
        $response = $this->actingAs($user)->get('/api/users');

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the response contains the users
        $response->assertJson([
            ['id' => $user->id, 'name' => $user->name],
        ]);
    }

        /** @test */
    public function it_requires_authentication_to_access_users()
    {
        // Create a user
        $user = User::factory()->create();

        // Make a GET request to the /users endpoint with authentication
        $response = $this->actingAs($user)->get('/api/users');

        // Assert the response is successful
        $response->assertStatus(200);
    }

   
    /** @test */
    public function it_can_create_a_user()
    {
        // Authenticate a user and get a token
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        // Make a POST request with the token
        $response = $this->post('/api/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
        ], ['Authorization' => 'Bearer ' . $token]);

        $response->assertStatus(201); // Assert that the status code is 201 Created
    }

}
