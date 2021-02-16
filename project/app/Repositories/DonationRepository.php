<?php

namespace App\Repositories;

use App\Models\Donation;

class DonationRepository extends Repository
{
    protected function getClass()
    {
        return Donation::class;
    }

}
