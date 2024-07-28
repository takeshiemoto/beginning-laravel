<?php

namespace Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $user = User::factory()->create();
        Todo::factory()->count(5)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/api/todos');
        $response->assertOk()->assertJsonCount(5);
    }
}
