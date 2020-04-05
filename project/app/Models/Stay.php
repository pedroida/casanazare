<?php

namespace App\Models;

use App\Scopes\SearchScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stay extends Model
{
    use SoftDeletes;
    use SearchScope;

    protected $searchBy = ['entry_date', 'departure_date'];
    protected $searchByRelationship = [
        'client' => ['name', 'rg'],
        'source' => ['name'],
        'responsible' => ['name', 'email']
    ];

    protected $fillable = [
        'entry_date',
        'departure_date',
        'comments',
        'source_id',
        'responsible_id',
        'client_id',
        'type',
    ];

    public function source()
    {
        return $this->belongsTo(Source::class)->withTrashed();
    }

    public function responsible()
    {
        return $this->belongsTo(User::class, 'responsible_id')->withTrashed();
    }

    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }
}
