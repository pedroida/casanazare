<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\Resource;

class SourceResource extends Resource
{
    public function toArray($request)
    {
        $user = current_user();

        return [
            'name' => $this->name,
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => $this->when(
                    $user->can('sources edit'),
                    route('admin.origens.edit', $this->resource)
                ),
                'show' => $this->when(
                    $user->can('sources show'),
                    route('admin.origens.show', $this->resource)
                ),
                'destroy' => $this->when(
                    $user->can('sources delete'),
                    route('admin.origens.destroy', $this->resource)
                ),
            ],
        ];
    }
}
