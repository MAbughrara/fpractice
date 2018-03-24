<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use recordsActivity;
    protected $guarded=[];


    public function favorited()
    {
        return $this->morphTo();
    }



}
