<?php

use App\Mail\TokenMail;
use App\Token;

use Illuminate\Support\Facades\Mail;

class RequestTokenTest extends FeatureTestCase
{

    function test_a_guest_user_can_request_a_token()
    {
        Mail::fake();

        $user = $this->defaultUser(['email' => 'admin@styde.net']);

        $this->visitRoute('token')
            ->type('admin@styde.net', 'email')
            ->press('Solicitar Token');

        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token);

        Mail::assertSentTo($user, TokenMail::class, function ($mail) use($token) {
            return $mail->token->id === $token->id;
        });

        $this->dontSeeIsAuthenticated();

        $this->seeRouteIs('login_confirmation')
            ->see('Envíamos a tu email un enlace para que inicies sesión');
    }

    function test_a_user_request_a_token_without_an_email()
    {
        Mail::fake();

        $this->visitRoute('token')
            ->press('Solicitar Token');

        $this->seeErrors([
            'email' => 'El campo correo electrónico es obligatorio'
        ]);
    }

    function test_a_user_request_a_token_without_a_non_existent_email()
    {


        $this->defaultUser(['email' => 'admin@styde.net']);

        $this->visitRoute('token')
            ->type('silence@styde.net', 'email')
            ->press('Solicitar Token');

        $this->seeErrors([
            'email' => 'Correo electrónico es inválido'
        ]);
    }

}
