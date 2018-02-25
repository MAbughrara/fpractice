<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $guarded=[];

    public function reply(){
        $this->belongsTo(Reply::class);
    }
}
