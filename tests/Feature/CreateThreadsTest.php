<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use function Symfony\Component\Console\Tests\Command\createClosure;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */

    function gusts_can_not_create_thread(){

        $this->withExceptionHandling()

            ->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads')
            ->assertRedirect('/login');

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
