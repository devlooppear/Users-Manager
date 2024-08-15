<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index endpoint to list users.
     *
     * @return void
     */
    public function test_index_lists_users(): void
    {
        $users = User::factory(3)->create();

        $user = User::first();
        Sanctum::actingAs($user);

        $response = $this->getJson(route('users.index'));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonFragment([
            'id' => $users[0]->id,
            'name' => $users[0]->name,
            'email' => $users[0]->email,
            'birth_date' => $users[0]->birth_date,
            'created_at' => $users[0]->created_at->toISOString(),
            'updated_at' => $users[0]->updated_at->toISOString(),
        ]);

        $response->assertJsonFragment([
            'id' => $users[1]->id,
            'name' => $users[1]->name,
            'email' => $users[1]->email,
            'birth_date' => $users[1]->birth_date,
            'created_at' => $users[1]->created_at->toISOString(),
            'updated_at' => $users[1]->updated_at->toISOString(),
        ]);

        $response->assertJsonFragment([
            'id' => $users[2]->id,
            'name' => $users[2]->name,
            'email' => $users[2]->email,
            'birth_date' => $users[2]->birth_date,
            'created_at' => $users[2]->created_at->toISOString(),
            'updated_at' => $users[2]->updated_at->toISOString(),
        ]);
    }

    /**
     * Test the index endpoint without authentication.
     *
     * @return void
     */
    public function test_index_requires_authentication(): void
    {
        $response = $this->getJson(route('users.index'));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test the show endpoint to display a specific user.
     *
     * @return void
     */
    public function test_show_displays_user(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson(route('users.show', $user->id));

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'birth_date' => $user->birth_date,
            'created_at' => $user->created_at->toISOString(),
            'updated_at' => $user->updated_at->toISOString(),
        ]);
    }

    /**
     * Test the show endpoint without authentication.
     *
     * @return void
     */
    public function test_show_requires_authentication(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson(route('users.show', $user->id));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test the store endpoint to create a new user.
     *
     * @return void
     */
    public function test_store_creates_user(): void
    {
        $user = User::factory()->make();

        Sanctum::actingAs($user);

        $response = $this->postJson(route('users.store'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password123',
            'birth_date' => $user->birth_date,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
            'birth_date' => $user->birth_date,
        ]);
    }

    /**
     * Test the update endpoint to update an existing user.
     *
     * @return void
     */
    public function test_update_updates_user(): void
    {
        $user = User::factory()->create();
        $updatedUser = User::factory()->make();

        Sanctum::actingAs($user);

        $response = $this->putJson(route('users.update', $user->id), [
            'name' => $updatedUser->name,
            'email' => $updatedUser->email,
            'password' => 'newpassword123',
            'birth_date' => $updatedUser->birth_date,
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment([
            'id' => $user->id,
            'name' => $updatedUser->name,
            'email' => $updatedUser->email,
            'birth_date' => $updatedUser->birth_date,
        ]);
    }

    /**
     * Test the destroy endpoint to delete a user.
     *
     * @return void
     */
    public function test_destroy_deletes_user(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->deleteJson(route('users.destroy', $user->id));

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    /**
     * Test the store endpoint without authentication.
     *
     * @return void
     */
    public function test_store_requires_authentication(): void
    {
        $response = $this->postJson(route('users.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'birth_date' => '2000-01-01',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test the update endpoint without authentication.
     *
     * @return void
     */
    public function test_update_requires_authentication(): void
    {
        $user = User::factory()->create();

        $response = $this->putJson(route('users.update', $user->id), [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => 'newpassword123',
            'birth_date' => '1999-12-31',
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test the destroy endpoint without authentication.
     *
     * @return void
     */
    public function test_destroy_requires_authentication(): void
    {
        $user = User::factory()->create();

        $response = $this->deleteJson(route('users.destroy', $user->id));

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
