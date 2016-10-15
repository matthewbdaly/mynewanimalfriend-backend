<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use AnimalFriend\User;

class UserControllerTest extends TestCase
{
    /**
     * Test creating a user - invalid
     *
     * @return void
     */
    public function testPostingInvalidUser()
    {
        // Create a request
        $data = array(
            'name' => 'Bob Smith',
            'email' => 'bob@example.com'
        );
        $this->json('POST', '/api/users', $data);
        $this->assertResponseStatus(422);
    }

    /**
     * Test creating a user
     *
     * @return void
     */
    public function testPostingUser()
    {
        // Create a request
        $data = array(
            'name' => 'Bob Smith',
            'email' => 'bob@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        );
        $this->json('POST', '/api/users', $data);
        $this->assertResponseStatus(201);
        $this->seeInDatabase('users', ['email' => 'bob@example.com']);

        // Check user exists
        $saved = User::first();
        $this->assertEquals($saved->email, 'bob@example.com');
        $this->assertEquals($saved->name, 'Bob Smith');
    }

    /**
     * Test creating a duplicate user
     *
     * @return void
     */
    public function testPostingDuplicateUser()
    {
        // Create user
        $user = factory(AnimalFriend\User::class)->create([
            'name' => 'Bob Smith',
            'email' => 'bob@example.com',
            'password' => 'password'
        ]);
        $this->seeInDatabase('users', ['email' => 'bob@example.com']);

        // Create a request
        $data = array(
            'name' => 'Bob Smith',
            'email' => 'bob@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        );
        $this->json('POST', '/api/users', $data);
        $this->assertResponseStatus(422);
    }
}
