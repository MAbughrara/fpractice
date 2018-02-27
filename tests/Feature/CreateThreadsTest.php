<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */

    function gusts_can_not_create_thread()
    {

        $this->withExceptionHandling()
            ->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');

    }


    /**
     * @test
     */

    function a_authenticated_user_can_create_new_forum_threads()
    {

        $this->signIn();

        $thread = create('App\Thread');

        $response = $this->post('/threads', $thread->toArray());
        $this->get($response->headers->get('location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);


    }

    /**
     * @test
     */

    function a_thread_requires_a_title()
    {

        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /**
     * @test
     */

    function a_thread_requires_a_body()
    {

        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /**
     * @test
     */

    function a_thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 7777])
            ->assertSessionHasErrors('channel_id');
    }


    /**
     * @test
     */

    function unauthorized_users_cannot_delete_threads()
    {
        $this->withExceptionHandling();

        $thread = create('App\Thread');

        $this->delete($thread->path())->assertRedirect('/login');
        $this->signIn();
        $this->delete($thread->path())->assertStatus(403);

    }

    /**
     * @test
     */

    function authorized__user_can_delete_threads()
    {

        $this->signIn();

        $thread = create('App\Thread',['user_id' => auth()->id()]);
        $reply = create('App\Reply', ['thread_id' => $thread->id]);

        $response=$this->json('DELETE',$thread->path());
        $response->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }


    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();
        $thread = make('App\Thread', $overrides);
        return $this->post('/threads', $thread->toArray());
    }

}
