<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class State extends Model
{

    protected $table = 'states';
    protected $fillable = ['name', 'abbr'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'];
    }

    public function getAbbrAttribute()
    {
        return $this->attributes['abbr'];
    }
}
