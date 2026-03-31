<?php

namespace Tests\Unit\User;

use App\Entity\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\CreateUserWithSchool;

class UserTest extends TestCase
{
    use RefreshDatabase, CreateUserWithSchool;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        [$this->admin] = $this->createUserWithSchool('admin');
    }

    public function test_can_create_a_user(): void
    {
        $this->actingAs($this->admin);

        $response = $this->postJson('/user/store', [
            'last_name'  => 'Dupont',
            'first_name' => 'Jean',
            'email'      => 'jean.dupont@test.com',
            'password'   => 'password123',
            'role'       => 'teacher',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('users', [
            'email' => 'jean.dupont@test.com',
        ]);
    }

    public function test_cannot_create_user_with_invalid_data(): void
    {
        $this->actingAs($this->admin);

        $response = $this->postJson('/user/store', [
            'last_name'  => '',
            'email'      => 'pas-un-email',
            'password'   => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_can_update_a_user(): void
    {
        $this->actingAs($this->admin);

        [$user] = $this->createUserWithSchool('teacher');

        $response = $this->postJson("/user/{$user->id}/update", [
            'last_name'  => 'Nouveau',
            'first_name' => 'Prenom',
            'email'      => 'nouveau@test.com',
            'password'   => 'password123',
            '_method'    => 'PATCH',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('users', [
            'id'    => $user->id,
            'email' => 'nouveau@test.com',
        ]);
    }

    public function test_can_delete_a_user(): void
    {
        $this->actingAs($this->admin);

        [$user] = $this->createUserWithSchool('teacher');

        $response = $this->deleteJson("/user/{$user->id}");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

    public function test_guest_cannot_access_user(): void
    {
        [$user] = $this->createUserWithSchool('teacher');

        $response = $this->get(route('user.show', $user->id));

        $response->assertRedirect('/login');
    }
}
