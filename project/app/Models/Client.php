<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Carbon\Carbon;
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

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function setDateOfBirthAttribute($date)
    {
        if ($date)
            return $this->attributes['date_of_birth'] = Carbon::createFromFormat('d/m/Y', $date);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function stays()
    {
        return $this->hasMany(Stay::class);
    }

    public function getYearsOldAttribute()
    {
        return now()->diffInYears($this->date_of_birth);
    }
}
