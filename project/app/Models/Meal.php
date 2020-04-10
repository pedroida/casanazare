<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use SoftDeletes;
    use SearchScope;

    protected $searchBy = ['day', 'breakfasts', 'lunches', 'dinners'];

    protected $fillable = ['day', 'breakfasts', 'lunches', 'dinners'];
}
