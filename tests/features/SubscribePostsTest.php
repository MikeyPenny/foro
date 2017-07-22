<?php


use App\User;

class SubscribePostsTest extends FeatureTestCase
{

    function test_a_user_can_subscribe_to_a_post()
    {
        // Probando que un usario puede suscribirse a un post

        $post = $this->createPost();  // Crear el post

        $user = factory(User::class)->create(); // Crear el user

        $this->actingAs($user); // El usuario debe estar en sesión

        // When
        $this->visit($post->url) // Visita la url del post
            ->press('Suscribirse al post'); // y presione el botón suscribirse

        // Then
        $this->seeInDatabase('subscriptions', [ // Ver en la bas en la tabla subscriptions
           'user_id' => $user->id, // Que el id pertenece
            'post_id' => $post->id, // al id del post
        ]);

        $this->seePageIs($post->url) // Redireccionar a la url del post
            ->dontSee('Suscribirse al post'); // Ya no ver el botón de suscribirse puesto que ya se efectuó

    }

    function test_a_user_can_un_subscribe_from_a_post()
    {
        $post = $this->createPost();

        $user = factory(User::class)->create();

        $user->subscribedTo($post);
        $this->actingAs($user);

        $this->visit($post->url)
            ->dontSee('Suscribirse al post')
            ->press('Desuscribirse del post');

        $this->dontSeeInDatabase('subscriptions',[
           'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        $this->seePageIs($post->url);

    }

}
