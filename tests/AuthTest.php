<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test the auth
     *
     * @return void
     */
    public function testAuth()
    {
        // Create a User
        $user = factory(AnimalFriend\User::class)->create([
            'name' => 'bobsmith',
            'email' => 'bob@example.com',
            'password' => bcrypt('password')
        ]);

        // Create request
        $data = array(
            'email' => $user->email,
            'password' => 'password',
        );
        $response = $this->call('POST', '/api/authenticate', $data);
        $this->assertResponseStatus(200);
        $content = json_decode($response->getContent());
        $this->assertTrue(array_key_exists('token', $content));
    }

    /**
     * Test the auth when user does not exist
     *
     * @return void
     */
    public function testAuthFailure()
    {
        // Create data for request
        $data = array(
            'email' => 'user@example.com',
            'password' => 'password',
        );
        $response = $this->call('POST', '/api/authenticate', $data);

        // Check the status code
        $this->assertResponseStatus(401);
    }
}
