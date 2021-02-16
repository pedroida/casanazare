<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\Resource;

class UnitResource extends Resource
{
    public function toArray($request)
    {
        $user = current_user();

        return [
            'name' => $this->name,
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => $this->when(
                    $user->can('units edit'),
                    route('admin.unidades.edit', $this->resource)
                ),
                'destroy' => $this->when(
                    $user->can('units delete'),
                    route('admin.unidades.destroy', $this->resource)
                ),
            ],
        ];
    }
}
