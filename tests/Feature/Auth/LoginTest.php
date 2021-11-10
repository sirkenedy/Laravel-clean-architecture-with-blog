<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginWithoutErrors()
    {
        $this->withoutExceptionHandling();
        User::factory()->create([
            "email" => "test@gmail.com",
            "password" => "secret1234",
        ]);
        $data = [
            'email' => 'test@gmail.com',
            'password' => 'secret1234',
        ];
        //Send post request
        $response = $this->json('POST','api/login',$data);
        //Assert it was successful
        $response->assertStatus(200)
        ->assertJsonStructure([
            'success',
            'data' => [
                'name',
                'token'
            ],
            'message',
        ]);
    }

    public function testLoginWithWrongPassword()
    {
        $this->withoutExceptionHandling();
        User::factory()->create([
            "email" => "test@gmail.com",
            "password" => "secret1234",
        ]);
        $data = [
            'email' => 'test@gmail.com',
            'password' => 'secret123',
        ];
        //Send post request
        $response = $this->json('POST','api/login',$data);
        //Assert it was successful
        $response->assertStatus(404)
        ->assertJsonStructure([
            'success',
            'data' => [
                "error",
            ],
            'message',
        ]);
    }

    public function testLoginWithNonExistingEmail()
    {
        $data = [
            'email' => 'test1323@gmail.com',
            'password' => 'secret123',
        ];
        //Send post request
        $response = $this->json('POST','api/login', $data);
        //Assert it was successful
        $response->assertStatus(422)
        ->assertJsonStructure([
            'errors' => [
                "email" ,
            ],
            'message',
        ]);
    }
    
    public function testLoginWithEmptyCredential()
    {
        $data = [
            //
        ];
        //Send post request
        $response = $this->json('POST','api/login', $data);
        //Assert it was successful
        $response->assertStatus(422)
        ->assertJsonStructure([
            'errors' => [
                "email" ,
                "password"
            ],
            'message',
        ]);
    }
}
