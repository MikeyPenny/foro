<?php

use App\Notifications\PostCommented;
use App\User;
use Illuminate\Support\Facades\Notification;

class NotifyUsersTest extends FeatureTestCase
{

    public function test_the_subscribers_receive_a_notification_when_the_post_is_commented()
    {

        Notification::fake();

        $post = $this->createPost();

        $subscriber = factory(User::class)->create();

        $subscriber->subscribedTo($post);

        $writer = factory(User::class)->create();

        $writer->subscribedTo($post);

        $comment = $writer->comment($post, 'Un comentario cualquiera');

        Notification::assertSentTo(
            $subscriber, PostCommented::class, function ($notification) use ($comment) {
                return $notification->comment->id == $comment->id;
            }
        );
        // The author of the comment should not be notified even if he or she is a subscriber.
        Notification::assertNotSentTo($writer, PostCommented::class);

    }
}
