<?php

namespace App\Http\Resources\Voluntary;

use Illuminate\Http\Resources\Json\Resource;

class StayResource extends Resource
{
    public function toArray($request)
    {
        $user = current_user();

        return [
            'client_name' => $this->client->name . ' (' . $this->client->years_old . ' anos)',
            'source_name' => $this->source->name,
            'created_at' => format_date($this->created_at),
            'responsible_name' => optional($this->responsible)->name ?? 'Não definido',
            'type' => __('labels.common.' . $this->type),
            'entry_date' => format_date($this->entry_date, 'd/m/Y'),
            'departure_date' => format_date($this->departure_date, 'd/m/Y'),
            'links' => [
                'edit' => $this->when(
                    $user->can('stays edit'),
                    route('voluntary.estadias.edit', $this->resource)
                ),
                'destroy' => $this->when(
                    $user->can('stays delete'),
                    route('voluntary.estadias.destroy', $this->resource)
                ),
            ],
        ];
    }
}
