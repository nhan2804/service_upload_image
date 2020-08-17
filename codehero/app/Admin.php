<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table= "accounts";
    protected $keyPrimary= "id";
    public function posts()
    {
        return $this->hasMany('App\Forum');
    }
}
