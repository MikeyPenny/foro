<?php

use App\{Comment, Post, User};
use App\Notifications\PostCommented;
use Illuminate\Notifications\Messages\MailMessage;

class PostCommentedTest extends TestCase
{


    /**
     * @test
     */
    function it_builds_a_mail_message()
    {

        $post = new Post([
            'title' => 'Título del post'
        ]);

        $author = new User([
           'first_name' => 'Mickey',
            'last_name' => 'Sandoval',
        ]);

        $comment = new Comment();
        $comment->post = $post;
        $comment->user = $author;

        $notification = new PostCommented($comment);

        $subscriber = new User();

        $message = $notification->toMail($subscriber);

        $this->assertInstanceOf(MailMessage::class, $message);

        $this->assertSame(
            'Nuevo comentario en: Título del post',
            $message->subject
        );

        $this->assertSame(
            'Mickey Sandoval escribió un comentario en: Título del post',
            $message->introLines[0]
        );

        $this->assertSame($comment->post->url, $message->actionUrl);

    }
}
