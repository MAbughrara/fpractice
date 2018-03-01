<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];


    public function subject()
    {
        return $this->morphTo();
    }
    public static function feed(User $user, $take=40)
    {
        return static::where('user_id',$user->id)
            ->latest()
            ->with('subject')
            ->take($take)
            ->get()
            ->groupBy(function ($activities) {
            return $activities->created_at->format('Y-m-d');
        });
    }

}

