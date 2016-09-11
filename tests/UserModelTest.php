<?php

use AnimalFriend\User;

class UserModelTest extends TestCase
{
    /**
     * Test creating a user
     *
     * @return void
     */
    public function testCreatingAUser()
    {
        // Create a User
        $user = factory(AnimalFriend\User::class)->create([
            'name' => 'bobsmith',
            'email' => 'bob@example.com',
        ]);
        $this->seeInDatabase('users', ['email' => 'bob@example.com']);

        // Verify it works
        $saved = User::where('email', 'bob@example.com')->first();
        $this->assertEquals($saved->id, 1);
        $this->assertEquals($saved->name, 'bobsmith');
    }
}
