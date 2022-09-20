<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Factory as Faker;


class UserTest extends TestCase
{
    /** @test */
    public function user_can_store_a_create_user()
    {
        $faker = Faker::create();

        $response = $this->postJson("/api/users",[
            'name' => $faker->name(),
            'year_of_birth' => $faker->date( 'Y-m-d')
        ]);
        $user = $response['data'];

        $response->assertSuccessful();
        $this->assertNotNull($user);

        $this->delete('/api/users/'. $user['id']);
    }

    /** @test */
    public function returns_unprocessable_when_parameters_are_missing()
    {
        $response = $this->postJson("/api/users");
        $response->assertUnprocessable();
    }

    /** @test */
    public function user_can_get_a_single_single()
    {
        $faker = Faker::create();

        $response = $this->postJson("/api/users",[
            'name' => $faker->name(),
            'year_of_birth' => $faker->date()
        ]);
        $user = $response['data'];

        $response = $this->getJson("/api/users/" . $user['id']);

        $response->assertSuccessful();
        $this->assertNotNull($response['data']);

        $this->delete('/api/users/'. $user['id']);
    }

    /** @test */
    public function returns_404_when_resource_is_not_found()
    {
        $faker = Faker::create();

        $response = $this->postJson("/api/users",[
            'name' => $faker->name(),
            'year_of_birth' => $faker->date()
        ]);
        $user = $response['data'];

        $response = $this->getJson("/api/users/" . $user['id'] + 1);

        $response->assertNotFound();
        $this->assertNull($response['data']);

        $this->delete('/api/users/'. $user['id']);
    }

    /** @test */
    public function user_can_update_a_single_single()
    {
        $faker = Faker::create();

        $response = $this->postJson("/api/users",[
            'name' => $faker->name(),
            'year_of_birth' => $faker->date()
        ]);
        $user = $response['data'];

        $response = $this->putJson("/api/users/" . $user['id'],
            [
                'name' => $faker->name(),
                'year_of_birth' => $faker->date()
            ]);

        $response->assertSuccessful();
        $this->assertNotNull($response['data']);

        $this->delete('/api/users/'. $user['id']);
    }

    /** @test */
    public function returns_404_when_update_user()
    {
        $faker = Faker::create();

        $response = $this->postJson("/api/users",
            [
                'name' => $faker->name(),
                'year_of_birth' => $faker->date()
            ]);
        $user = $response['data'];

        $response = $this->putJson("/api/users/" . $user['id'] + 1,
            [
                'name' => $faker->name(),
                'year_of_birth' => $faker->date()
            ]);

        $response->assertNotFound();
        $this->assertNull($response['data']);

        $this->delete('/api/users/'. $user['id']);
    }

    /** @test */
    public function returns_unprocessable_when_update_parameters_are_missing()
    {
        $faker = Faker::create();

        $response = $this->postJson("/api/users",[
            'name' => $faker->name(),
            'year_of_birth' => $faker->date()
        ]);
        $user = $response['data'];

        $response = $this->putJson("/api/users/" . $user['id']);
        $response->assertUnprocessable();

        $this->delete('/api/users/'. $user['id']);
    }

    /** @test */
    public function user_can_delete_a_single_user()
    {
        $faker = Faker::create();

        $response = $this->postJson("/api/users",[
            'name' => $faker->name(),
            'year_of_birth' => $faker->date( 'Y-m-d')
        ]);
        $user = $response['data'];

        $response = $this->delete('/api/users/'. $user['id']);

        $response->assertSuccessful();
    }

    /** @test */
    public function returns_404_when_delete_user()
    {
        $faker = Faker::create();

        $response = $this->postJson("/api/users",[
            'name' => $faker->name(),
            'year_of_birth' => $faker->date( 'Y-m-d')
        ]);
        $user = $response['data'];

        $response = $this->delete("/api/users/" . $user['id'] + 1);

        $response->assertNotFound();

        $this->delete('/api/users/'. $user['id']);
    }

    /** @test */
    public function user_can_get_all_users()
    {
        $response = $this->get("/api/users");
        $response->assertSuccessful();
    }
}
