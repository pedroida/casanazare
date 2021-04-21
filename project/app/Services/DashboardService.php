<?php

namespace App\Services;

use App\Models\Meal;
use App\Models\Stay;
use App\Repositories\Criterias\Common\GroupBy;
use App\Repositories\Criterias\Common\Where;
use App\Repositories\Criterias\Common\WhereBetween;
use App\Repositories\Criterias\Common\With;
use App\Repositories\DonationRepository;
use App\Repositories\MealRepository;
use App\Repositories\Repository;
use App\Repositories\StayRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        if ($this->type === 'month')
            return [
                $carbonDate->startOfMonth()->format('Y/m/d'),
                $carbonDate->endOfMonth()->format('Y/m/d')
            ];

        return [$carbonDate->startOfYear()->format('Y/m/d'), $carbonDate->endOfYear()->format('Y/m/d')];
    }

    public function getData()
    {
        $meals = $this->getMeals();
        $staysGraphic = $this->getStaysGraphic();
        $donations = $this->getDonations();
        $staysCount = $this->getStaysCount();

        return [
            'meals' => $meals,
            'donations' => $donations,
            'stays_count' => $staysCount,
            'stays_graphic' => $staysGraphic,
        ];
    }

    private function getMeals()
    {
        $meals = (new MealRepository())->pushCriteria([
            new WhereBetween('day', ...$this->dateInterval),
        ])->all(['day', 'breakfasts', 'lunches', 'dinners']);

        if ($meals->isEmpty())
            return [
                'breakfasts' => 0,
                'lunches' => 0,
                'dinners' => 0,
                'total' => 0,
            ];

        return $meals->reduce(function ($carry, $meal) {
            if (!$carry) {
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

    private function getStaysGraphic()
    {
        date_default_timezone_set('America/Sao_Paulo');
        setlocale(LC_ALL, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');
        setlocale(LC_TIME, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');


        $labels = [];
        $data = [];
        $colors = [];
        $borderColors = [];

        if ($this->type === 'month') {
            Stay::query()
                ->whereBetween('entry_date', $this->dateInterval)
                ->select('entry_date', DB::raw('count(entry_date) as total'))
                ->groupBy('entry_date')
                ->get()
                ->groupBy
                ->entry_date
                ->each(function ($stays, $entryDate) use (&$labels, &$data, &$colors, &$borderColors) {
                    $labels[] = Carbon::createFromFormat('Y-m-d', $entryDate)->format('d/m');
                    $data[] = $stays->first()->total;
                    $rgb = $this->randomRgb();
                    $colors[] = "rgba({$rgb},0.5)";
                    $borderColors[] = "rgba({$rgb},1)";
                });

            return ['labels' => $labels, 'data' => $data, 'colors' => $colors, 'borderColors' => $borderColors];
        }

        Stay::query()
            ->whereBetween('entry_date', $this->dateInterval)
            ->select(DB::raw("date_trunc('month', entry_date)::date as month"), DB::raw('count(entry_date) as total'))
            ->groupBy('month')
            ->get()
            ->groupBy
            ->month
            ->each(function ($stays, $entryDate) use (&$labels, &$data, &$colors, &$borderColors) {
                $labels[] = Carbon::createFromFormat('Y-m-d', $entryDate)->formatLocalized('%B');
                $data[] = $stays->first()->total;
                $rgb = $this->randomRgb();
                $colors[] = "rgba({$rgb},0.5)";
                $borderColors[] = "rgba({$rgb},1)";
            });

        return ['labels' => $labels, 'data' => $data, 'colors' => $colors, 'borderColors' => $borderColors];
    }

    private function randomRgb()
    {
        $rgbColor = [];
        foreach(['r', 'g', 'b'] as $color){
            $rgbColor[$color] = mt_rand(0, 255);
        }

        return implode(',', $rgbColor);
    }
}