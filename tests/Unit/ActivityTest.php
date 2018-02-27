<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    function it_records_activity_when_a_thread_id_created()
    {
        $this->signIn();
        $thread=create('App\Thread');
        $this->assertDatabaseHas('activities',[
           'type'=>'created_thread',
           'user_id'=>auth()->id(),
           'subject_id'=>$thread->id,
           'subject_type'=>'App\Thread'
        ]);
    }

}