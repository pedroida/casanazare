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
            'quantity' => $this->formatted_quantity,
            'category' => optional($this->category)->name,
            'created_at' => format_date($this->created_at),
            'validate' => format_date($this->validate, 'd/m/Y'),
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
