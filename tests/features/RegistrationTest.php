<?php

use App\Mail\TokenMail;
use App\Token;
use App\User;
use Illuminate\Support\Facades\Mail;

class RegistrationTest extends FeatureTestCase
{

    function test_a_user_can_create_an_account()
    {
        Mail::fake();

        $this->visitRoute('register')
            ->type('miguelship3@gmail.com', 'email')
            ->type('penny', 'username')
            ->type('Mickey', 'first_name')
            ->type('Sandoval', 'last_name')
            ->press('Regístrate');

        $this->seeInDatabase('users', [
           'email' => 'miguelship3@gmail.com',
            'username' => 'penny',
            'first_name' => 'Mickey',
            'last_name' => 'Sandoval'
        ]);

        $user = User::first();

        $this->seeInDatabase('tokens', [
           'user_id' => $user->id
        ]);

        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token);

        Mail::assertSentTo($user, TokenMail::class, function ($mail) use ($token) {
            return $mail->token->id == $token->id;
        });

        $this->seeRouteIs('register_confirmation')
            ->see('Gracias por registrarte')
            ->see('Envíamos a tu email un enlace para que inicies sesión');

    }


}
