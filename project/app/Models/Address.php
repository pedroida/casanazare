<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $table = 'addresses';

    protected $fillable = [
        'zip_code',
        'street',
        'number',
        'district',
        'state_id',
        'city_id',
    ];

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\State');
    }

    public function setZipCodeAttribute($value)
    {
        $formated = preg_replace("/[^0-9,.]/", "", $value);
        $this->attributes['zip_code'] = $formated;
    }

    public function getCompleteAddressAttribute()
    {
        if ($this->city_id && $this->state_id) {
            $city =  $this->city;

            $state = $this->state;
            $city = $city->name;
            $state = $state->abbr;

            return $this->street . ', '
                . $this->number . ' '
                . $this->district . ', '
                . $this->cep . ' '
                . $city . ' - '
                . $state . ', '
                . $this->zip_code;
        }
    }
}
