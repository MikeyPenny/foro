<?php

namespace App\Http\Controllers;

use App\Post;

class SubscriptionController extends Controller
{
    public function subscribe(Post $post)
    {
        /*Subscription::create([ Creamos una subscripcion con el id del post y el id del user que está en la
            'post_id' => $post->id, autenticación o en sesión
            'user_id' => auth()->id();
        ]);*/

        // También se puede creando la relación dentro del modelo usuario con la propiedad attach enviando
        // el post como parámetro

        auth()->user()->subscribedTo($post);

        return redirect($post->url);

    }



}
