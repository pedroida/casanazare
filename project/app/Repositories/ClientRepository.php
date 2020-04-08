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
        return $this->model->whereDoesntHave('stays', function ($query) {
            return $query->whereNull('departure_date');
        })->get();
    }
}
