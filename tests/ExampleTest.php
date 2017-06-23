<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    use DatabaseTransactions;

    public function testBasicExample()
    {
        $name = 'Mickey Sandoval';

        $user = factory(\App\User::class)->create([
            'name' => $name,
            'email' => 'miguelship3@gmail.com',
        ]);

        $this->actingAs($user, 'api')
            ->visit('api/user')
            ->see($name)
            ->see('miguelship3@gmail.com');
    }
}
