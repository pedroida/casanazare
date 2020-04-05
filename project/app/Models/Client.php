<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    use SearchScope;

    protected $searchBy = [
        'name', 'rg', 'date_of_birth', 'phone_one', 'phone_two'
    ];

    protected $searchByRelationship = [
      'city' => ['name'],
      'city.state' => ['name', 'abbr'],
    ];

    protected $fillable = [
        'name', 'rg', 'date_of_birth', 'phone_one', 'phone_two', 'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
