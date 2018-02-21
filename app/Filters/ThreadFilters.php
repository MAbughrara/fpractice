<?php

namespace App\Filters ;


use App\Channel;
use App\User;

class ThreadFilters extends Filters
{

    protected $filters=['by','channelName'];

    /**
     * @param $username
     * @return mixed
     */
    protected function by($username)
    {
        $user=User::where('name',$username)->firstOrFail();
        return $this->builder->where('user_id',$user->id);
    }
    protected function channelName($channelName)
    {
        $channel=Channel::where('slug',$channelName)->firstOrFail();
        return $this->builder->where('channel_id',$channel->id);
    }
}