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
                    $user->can('users edit client'),
                    route('admin.acolhidos.edit', $this->id)
                ),
                'show' => $this->when(
                    $user->can('users show client'),
                    route('admin.acolhidos.show', $this->id)
                ),
                'destroy' => $this->when(
                    $user->can('users delete client'),
                    route('admin.acolhidos.destroy', $this->id)
                ),
            ],
        ];
    }
}
