<?php

namespace App\Http\Resources\Voluntary;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class MealResource extends Resource
{
    public function toArray($request)
    {
        $user = current_user();
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        return [
            'id' => $this->id,
            'lunches' => $this->lunches,
            'dinners' => $this->dinners,
            'breakfasts' => $this->breakfasts,
            'day_formatted' => format_date($this->day, 'd/m/Y'),
            'day' => format_date($this->day, 'Y,m,d'),
            'week_day' => Carbon::parse($this->day)->translatedFormat('l'),
            'created_at' => format_date($this->created_at),
            'links' => [
                'edit' => $this->when(
                    $user->can('meals edit'),
                    route('voluntary.refeicoes.update', $this->resource)
                ),
                'destroy' => $this->when(
                    $user->can('meals delete'),
                    route('voluntary.refeicoes.destroy', $this->resource)
                ),
            ],
        ];
    }
}
