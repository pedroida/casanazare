<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\Resource;

class CategoryResource extends Resource
{
    public function toArray($request)
    {
        $user = current_user();

        return [
            'name' => $this->name,
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => $this->when(
                    $user->can('categories edit'),
                    route('admin.categorias.edit', $this->resource)
                ),
                'destroy' => $this->when(
                    $user->can('categories delete'),
                    route('admin.categorias.destroy', $this->resource)
                ),
            ],
        ];
    }
}
