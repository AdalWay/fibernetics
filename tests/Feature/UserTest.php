<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

    }
    public function test_can_create_an_user()
    {
       $user =  User::factory()->make();

         $this->postJson(route('users.store'), ['name' => $user->name, 'age' => $user->age, 'department' => $user->department])
            ->assertCreated()
            ->json();
        $this->assertDatabaseHas('users', ['age'=> $user->age, 'name' => $user->name ]);

    }

    public function test_can_list_all_users()
    {
          User::factory()->count(10)->create();

        $response = $this->getJson(route('users.index'),);

        $response->assertOk()
            ->assertJsonCount(10)
            ->json();

    }

    public function test_can_list_one_specific_user_by_it_id()
    {
          $user = User::factory()->count(10)->create()[4];

        $response = $this->getJson(route('users.show', ['user' => $user->id ]));

        $response->assertOk()
            ->assertJson(['name' => $user->name, 'department' => $user->department])
            ->json();

    }

    public function test_can_delete_one_specific_user_by_it_id()
    {
          $user = User::factory()->count(10)->create()[5];

        $response = $this->deleteJson(route('users.destroy', ['user' => $user->id ]));

        $this->assertDatabaseMissing('users', ['name' => $user->name]);

        $response->assertNoContent(status: 204);

    }

    //NOTE: I have use Post updating because laravel has a well know issues with PATCH and PUT.
    public function test_can_update_one_specific_user_by_it_id()
    {
          $user = User::factory()->create();

         $this->postJson(route('users.update', ['user' => $user->id ]), ['name' => 'Adalberto Cuevas'])
        ->assertOk();
        $this->assertDatabaseHas('users', ['name' => 'Adalberto Cuevas']);

    }





}
