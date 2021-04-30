<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use SoftDeletes;
    use SearchScope;

    protected $searchBy = ['day', 'breakfasts', 'lunches', 'dinners'];

    protected $fillable = ['day', 'breakfasts', 'lunches', 'dinners'];

    protected $casts = ['day' => 'date'];

    public function setDayAttribute($value)
    {
        if(!$value)
            return null;

        $value = Carbon::createFromFormat('d/m/Y', $value);
        return $this->attributes['day'] = $value;
    }
}
