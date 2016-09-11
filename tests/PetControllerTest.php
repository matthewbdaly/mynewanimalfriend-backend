<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class PetControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test fetching pets when unauthorised
     *
     * @return void
     */
    public function testFetchingPetsWhenUnauthorised()
    {
        // Create a Pet
        $user = factory(AnimalFriend\Pet::class)->create([
            'name' => 'Freddie',
            'type' => 'Cat',
        ]);
        $this->seeInDatabase('pets', ['type' => 'Cat']);

        // Create request
        $response = $this->call('GET', '/api/pets');
        $this->assertResponseStatus(400);
    }

    /**
     * Test fetching pets when authorised
     *
     * @return void
     */
    public function testFetchingPets()
    {
        // Create a Pet
        $user = factory(AnimalFriend\Pet::class)->create([
            'name' => 'Freddie',
            'type' => 'Cat',
        ]);
        $this->seeInDatabase('pets', ['type' => 'Cat']);

        // Create a User
        $user = factory(AnimalFriend\User::class)->create([
            'name' => 'bobsmith',
            'email' => 'bob@example.com',
        ]);
        $this->seeInDatabase('users', ['email' => 'bob@example.com']);

        // Create request
        $token = JWTAuth::fromUser($user);
        $headers = array(
            'Authorization' => 'Bearer '.$token
        );

        // Send it
        $this->json('GET', '/api/pets', [], $headers)
            ->seeJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'type',
                    'available',
                    'picture',
                    'created_at',
                    'updated_at'
                ]
            ]);
        $this->assertResponseStatus(200);
    }
}
