<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->thread=$thread= factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {

         $this->get('/threads')
            ->assertSee($this->thread->title);

    }
    /** @test */
    public function a_user_can_read_a_single_threads()
    {
        $this->get($this->thread->path())

        ->assertSee($this->thread->title);
    }

    /** @test */
    function a_user_can_read_replies_that_are_associated_with_a_thread ()
    {
        $reply = factory('App\Reply')->create(['thread_id'=> $this->thread->id]);
        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    function a_user_can_filter_according_to_a_channel(){

          $channel= create('App\Channel');
          $threadChannel=create('App\Thread',['channel_id'=>$channel->id]);
        $threadNotChannel=create('App\Thread');

          $this->get('/threads/'.$channel->slug)
              ->assertSee($threadChannel->title)
              ->assertDontSee($threadNotChannel->title);

    }
}

