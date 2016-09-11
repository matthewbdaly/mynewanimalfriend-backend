<?php

use AnimalFriend\Pet;

class PetModelTest extends TestCase
{
    /**
     * Test creating a user
     *
     * @return void
     */
    public function testCreatingAUser()
    {
        // Create a User
        $user = factory(AnimalFriend\Pet::class)->create([
            'name' => 'Freddie',
            'type' => 'Cat',
        ]);
        $this->seeInDatabase('pets', ['type' => 'Cat']);

        // Verify it works
        $saved = Pet::where('name', 'Freddie')->first();
        $this->assertEquals($saved->id, 1);
        $this->assertEquals($saved->name, 'Freddie');
        $this->assertEquals($saved->type, 'Cat');
        $this->assertEquals($saved->available, 1);
        $this->assertEquals($saved->picture, '1.jpg');
    }
}
