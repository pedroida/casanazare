<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\Resource;

class DonationResource extends Resource
{
    public function toArray($request)
    {
        $user = current_user();

        return [
            'name' => $this->name,
            'unit' => optional($this->unit)->name,
            'category' => optional($this->category)->name,
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => $this->when(
                    $user->can('donations edit'),
                    route('admin.doacoes.edit', $this->resource)
                ),
                'show' => $this->when(
                    $user->can('donations show'),
                    route('admin.doacoes.show', $this->resource)
                ),
                'destroy' => $this->when(
                    $user->can('donations delete'),
                    route('admin.doacoes.destroy', $this->resource)
                ),
            ],
        ];
    }
}
