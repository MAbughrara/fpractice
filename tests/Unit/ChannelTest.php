<?php

namespace Tests\Unit;

use App\Channel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;


/**
 * @property  thread
 */

class ChannelTest extends TestCase
{
    use DatabaseMigrations;


    /**
     * @test
     */
    function a_channel_consists_of_threads(){
       $channel= create('App\Channel');
       $thread= create('App\Thread',['channel_id'=>$channel->id]);

       $this->assertTrue($channel->threads->contains($thread));
    }
}
