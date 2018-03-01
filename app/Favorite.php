<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use recordsActivity;
    protected $guarded=[];
//
//    public function reply(){
//        $this->belongsTo(Reply::class);
//    }

    public function favorited()
    {
        return $this->morphTo();
    }



}
