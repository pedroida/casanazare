<?php

namespace App\Services;

use App\Repositories\Criterias\Common\GroupBy;
use App\Repositories\Criterias\Common\Where;
use App\Repositories\Criterias\Common\WhereBetween;
use App\Repositories\Criterias\Common\With;
use App\Repositories\DonationRepository;
use App\Repositories\MealRepository;
use App\Repositories\StayRepository;
use Carbon\Carbon;

class DashboardService
{
    private $type;
    private $date;
    private $dateInterval;

    public function __construct($type, $date)
    {
        $this->type = $type;
        $this->date = $date;
        $this->dateInterval = $this->handleDateByType();
    }

    private function handleDateByType()
    {
        $carbonDate = Carbon::createFromFormat('d/m/Y', $this->date);

        if($this->type === 'month')
            return [
                $carbonDate->startOfMonth()->format('Y/m/d'),
                $carbonDate->endOfMonth()->format('Y/m/d')
            ];

        return [$carbonDate->startOfYear(), $carbonDate->endOfYear()];
    }

    public function getData()
    {
        $meals = $this->getMeals();
        $stays = $this->getStaysCount();
        $donations = $this->getDonations();

        return [
            'meals' => $meals,
            'donations' => $donations,
            'stays_count' => $stays
        ];
    }

    private function getMeals()
    {
        $meals = (new MealRepository())->pushCriteria([
            new WhereBetween('day', ...$this->dateInterval),
        ])->all(['day', 'breakfasts', 'lunches', 'dinners']);

        if($meals->isEmpty())
            return [
                'breakfasts' => 0,
                'lunches' => 0,
                'dinners' => 0,
                'total' => 0,
            ];

        return $meals->reduce(function ($carry, $meal) {
            if(!$carry) {
                $carry['breakfasts'] = 0;
                $carry['lunches'] = 0;
                $carry['dinners'] = 0;
                $carry['total'] = 0;
            }

            $carry['breakfasts'] += $meal->breakfasts;
            $carry['lunches'] += $meal->lunches;
            $carry['dinners'] += $meal->dinners;
            $carry['total'] += ($meal->breakfasts + $meal->lunches + $meal->dinners);
            return $carry;
        });
    }

    private function getDonations()
    {
        return (new DonationRepository())->pushCriteria([
            new WhereBetween('updated_at', ...$this->dateInterval),
            new With(['category', 'unit'])
        ])->all();
    }

    private function getStaysCount()
    {
        return (new StayRepository())->pushCriteria([
            new WhereBetween('entry_date', ...$this->dateInterval),
        ])->count();

    }
}