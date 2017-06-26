<?php



class ExampleTest extends FeatureTestCase
{

    function test_basic_example()
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
