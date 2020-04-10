<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository extends Repository
{
    protected function getClass()
    {
        return Client::class;
    }

    public function getAvailableClients()
    {
        return $this->model
            ->where('forbidden', false)
            ->whereDoesntHave('stays', function ($query) {
                return $query->whereNull('departure_date');
            })->get();
    }
}
