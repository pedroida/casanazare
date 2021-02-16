<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    use SearchScope;

    protected $table = 'donation_units';

    protected $searchBy = ['name'];

    protected $fillable = ['name'];

    
}
