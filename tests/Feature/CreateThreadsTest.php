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

    function gust_can_not_create_thread(){

        $this->expectException('Illuminate\Auth\AuthenticationException');
        $thread= make('App\Thread');
        $this->post('/threads',$thread->toArray());

    }

    /**
     * @test
     */

    function a_authenticated_user_can_create_new_forum_thread(){

        $this->signIn();

        $thread= make('App\Thread');

        $this->post('/threads',$thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);


    }
}
