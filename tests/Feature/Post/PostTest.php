<?php

namespace Tests\Feature\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFetchAllPost()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()
            ->has(Post::factory()->count(3), 'posts')
            ->create();
        $response = $this->get('/api/posts');

        $response->assertStatus(200);
        // $response->dump();
        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => [
                     'id',
                     'title',
                     'description',
                     'imageUrl',
                     'imageSize',
                     'keywords',
                     'user' => [
                        'id',
                        'name',
                        'username',
                        'joined_on'
                     ],
                     'created_at',
                     'updated_at'
                ]
            ]
        ]);
    }

    public function testAuthenticatedUserCreatePost()
    {
        $user = User::factory()->create();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $data = Post::factory()->make([
            "user_id" => $user->id,
            "image" => $file,
        ]);
        $this->actingAs($user, $guard = 'sanctum');
        $response = $this->post('/api/posts', $data->toArray());
        $response->assertStatus(201)
            ->assertJsonPath('data.title', $data->title)
            ->assertJsonPath('data.user.name', $user->name)
            ->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'title',
                'description',
                'imageUrl',
                'imageSize',
                'keywords',
                'user' => [
                'id',
                'name',
                'username',
                'joined_on'
                ],
                'created_at',
                'updated_at',
            ],
            'message',
        ]);
    }

    public function testUnauthenticatedUserCreatePost()
    {
        $user = User::factory()->create();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $data = Post::factory()->make([
            "user_id" => $user->id,
            "image" => $file,
        ]);
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/posts', $data->toArray());
        $response->assertStatus(401)
            ->assertJsonStructure([
            'message',
        ]);
    }
}
