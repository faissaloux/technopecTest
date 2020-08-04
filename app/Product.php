<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function colors()
    {
        return $this->hasMany('App\Color');
    }

    public function materials()
    {
        return $this->hasMany('App\Material');
    }

    public function sizes()
    {
        return $this->hasMany('App\Size');
    }
}
