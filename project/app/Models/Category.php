<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use SearchScope;

    protected $table = 'donation_categories';

    protected $searchBy = ['name'];

    protected $fillable = ['name'];

    
}
