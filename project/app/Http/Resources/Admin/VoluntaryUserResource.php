<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\Resource;

class VoluntaryUserResource extends Resource
{
    public function toArray($request)
    {
        $user = current_user();

        return [
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => $this->when(
                    $user->can('users edit admin'),
                    route('admin.voluntarios.edit', $this->id)
                ),
                'show' => $this->when(
                    $user->can('users show admin'),
                    route('admin.voluntarios.show', $this->id)
                ),
                'destroy' => $this->when(
                    $user->can('users delete admin') && $this->id !== $user->id,
                    route('admin.voluntarios.destroy', $this->id)
                ),
            ],
        ];
    }
}
