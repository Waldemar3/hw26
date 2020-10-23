<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $attr = [
            'name' => 'MRPoshta',
            'email' => 'poshtamr@gmail.com',
            'password' => 'password',
        ];

        $CreateUser = $this->post('/users', $attr);

        $this->assertDatabaseHas('users', $attr);

        $CreateUser->assertStatus(200);

        $readUser = $this->get('/users/'.$CreateUser->json('id'));
        $readUser->assertSee('<h1>MRPoshta</h1>', false);

        $attr = [
            'name' => 'Poshta',
            'email' => 'poshta@gmail.com',
            'password' => 'newPassword',
        ];

        $updateUser = $this->put('/users/'.$CreateUser->json('id'), $attr);

        $this->assertDatabaseHas('users', $attr);

        $updateUser->assertStatus(200);

        $deleteUser = $this->delete('/users/'.$CreateUser->json('id'));
        $deleteUser->assertStatus(200);
    }
}
