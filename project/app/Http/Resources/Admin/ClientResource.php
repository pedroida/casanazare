<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\Resource;

class ClientResource extends Resource
{
    public function toArray($request)
    {
        $user = current_user();

        return [
            'name' => $this->name,
            'rg' => $this->rg,
            'phone_one' => $this->phone_one,
            'date_of_birth' => format_date($this->date_of_birth, 'd/m/Y'),
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => $this->when(
                    $user->can('clients edit'),
                    route('admin.acolhidos.edit', $this->id)
                ),
                'show' => $this->when(
                    $user->can('clients show'),
                    route('admin.acolhidos.show', $this->id)
                ),
                'destroy' => $this->when(
                    $user->can('clients delete'),
                    route('admin.acolhidos.destroy', $this->id)
                ),
                'forbid' => $this->when(
                    $user->can('clients forbid') && !$this->forbidden,
                    route('ajax.admin.toggle.forbidden', $this->resource)
                ),
                'allow' => $this->when(
                    $user->can('clients allow') && $this->forbidden,
                    route('ajax.admin.toggle.forbidden', $this->resource)
                ),
            ],
        ];
    }
}
