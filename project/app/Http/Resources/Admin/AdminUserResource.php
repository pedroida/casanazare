<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\Resource;

class AdminUserResource extends Resource
{
    public function toArray($request)
    {
        $user = current_user();

        $fields = [
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => $this->when(
                    $user->can('users edit admin'),
                    route('admin.administradores.edit', $this->id)
                ),
                'show' => $this->when(
                    $user->can('users show admin'),
                    route('admin.administradores.show', $this->id)
                ),
            ]
        ];

        if ($user->can('users delete admin') && $this->id !== $user->id)
            $fields['links']['destroy'] = route('admin.administradores.destroy', $this->id);

    }
}
