<?php

namespace Tests\Feature;

use App\Reply;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */

    function unauthenticated_user_may_not_add_replies()
    {

        $this->withExceptionHandling()
        ->post("/threads/some-thing/1/replies", [])
        ->assertRedirect('/login');
    }

    /** @test */

    function an_authenticated_user_may_participate_in_forum_thread()
    {
        $this->be($user = factory('App\User')->create());
        $thread = create('App\Thread');
        $reply = make('App\Reply');

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
    /** @test */

    function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply',['body'=>null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    /** @test */

    public function unauthenticated_user_cannot_deltete_replies()
    {
        $this->withExceptionHandling();
        $reply= create('App\Reply');
        $this->delete('/replies/'.$reply->id)
            ->assertRedirect('login');

        $this->signIn()->delete('/replies/'.$reply->id)
            ->assertStatus(403);


    }

    /** @test */
    public function an_authenticated_user_can_deltete_replies()
    {
        $this->signIn();
        $reply= create('App\Reply',['user_id'=>Auth()->id()]);
        $this->delete('/replies/'.$reply->id)->assertStatus(302);
        $this->assertDatabaseMissing('replies',['id'=>$reply->id]);

    }


    /** @test */

    public function unauthenticated_user_cannot_update_replies()
    {
        $this->withExceptionHandling();
        $reply= create('App\Reply');
        $this->patch('/replies/'.$reply->id)
            ->assertRedirect('login');

        $this->signIn()->patch('/replies/'.$reply->id)
            ->assertStatus(403);


    }
    /** @test */
    public function an_authenticated_user_can_update_replies()
    {
        $this->signIn();
        $reply= create('App\Reply',['user_id'=>Auth()->id()]);
        $updateBody='you have been hti dude';

        $this->patch("/replies/{$reply->id}",['body'=>$updateBody]);

        $this->assertDatabaseHas('replies',['id'=>$reply->id,'body'=>$updateBody]);

    }
}

