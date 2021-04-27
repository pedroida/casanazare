<?php

namespace App\Http\Controllers\Voluntary;

use App\Http\Controllers\Controller;
use App\Repositories\Criterias\Common\OrderBy;
use App\Repositories\StatesRepository;

class AddressController extends Controller
{
    public function getStatesJson(StatesRepository $statesRepository)
    {
        $states = $statesRepository->pushCriteria(new OrderBy('name', 'asc'))->all();
        return response($states, 200);
    }

    public function getCitiesJsonFor($state_uf)
    {
        $state = (new StatesRepository())->simpleFindBy('abbr' ,$state_uf);
        $cities = [];

        if ($state->isNotEmpty()) {
            $cities = $state->first()->cities;
        }

        return response($cities, 200);
    }
}
