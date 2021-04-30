<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use SoftDeletes;
    use SearchScope;

    protected $searchBy = ['name', 'quantity', 'validate', 'donation_category_id', 'donation_unit_id'];

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

    public function category()
    {
        return $this->belongsTo(Category::class, 'donation_category_id')->withTrashed();
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'donation_unit_id')->withTrashed();
    }

    public function setQuantityAttribute($value)
    {
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);

        return $this->attributes['quantity'] = $value;
    }

    public function getFormattedQuantityAttribute()
    {
        return number_format($this->quantity, '3', ',', '.');
    }
}
