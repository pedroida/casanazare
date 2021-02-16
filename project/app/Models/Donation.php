<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use SoftDeletes;
    use SearchScope;

    protected $searchBy = ['name', 'quantity', 'validate'];

    protected $searchByRelationship = [
        'category' => ['name'],
        'unit' => ['name'],
    ];

    protected $fillable = [
        'name',
        'quantity',
        'validate',
        'donation_category_id',
        'donation_unit_id',
    ];


}
