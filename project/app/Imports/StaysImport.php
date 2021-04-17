<?php

namespace App\Imports;

use App\Enums\StayTypeEnum;
use App\Models\City;
use App\Models\Client;
use App\Models\Source;
use App\Models\Stay;
use App\Repositories\Criterias\Common\Where;
use App\Repositories\Criterias\Common\WhereBetween;
use App\Repositories\StayRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;

class StaysImport implements ToCollection, WithHeadingRow, WithMapping
{
    public function collection(Collection $collection)
    {
        return $collection;
    }

    public function map($row): array
    {
        if (!array_filter($row))
            return $row;

        $client = $this->getClient($row);
        $stay = $this->createStay($row, $client);

        return [$client, $stay];
    }

    private function getClient(array $row): Client
    {
        $client = Client::firstOrNew([
            'name' => data_get($row, 'nome'),
            'rg' => data_get($row, 'rg'),
            'date_of_birth' => data_get($row, 'data_de_nascimento'),
            'city_id' => $this->getCity(data_get($row, 'cidade')),
        ]);

        $client->phone_one = data_get($row, 'telefone_1');
        $client->save();

        return $client;
    }

    private function getCity($cityName)
    {
        if (!$cityName)
            return null;

        $city = City::firstWhere('name', $cityName);

        return optional($city)->id;
    }

    private function createStay(array $row, Client $client): ?Stay
    {
        $type = (data_get($row, 'tipo') == 'paciente') ? StayTypeEnum::PATIENT : StayTypeEnum::COMPANION;
        $source = $this->getSource(data_get($row, 'origem'));

        if ($this->alreadyHasStayInPeriod($row, $client))
            return null;

        return Stay::create([
            'type' => $type,
            'client_id' => $client->id,
            'source_id' => $source->id,
            'entry_date' => data_get($row, 'entrada'),
            'departure_date' => data_get($row, 'saida'),
        ]);
    }

    private function alreadyHasStayInPeriod(array $row, Client $client)
    {
        $entryDate = Carbon::createFromFormat('d/m/Y', data_get($row, 'entrada'));
        $departureDate = Carbon::createFromFormat('d/m/Y', data_get($row, 'saida', now()->format('d/m/Y')));

        return (new StayRepository())->pushCriteria([
            new Where('client_id', $client->id),
            new Where(function ($query) use ($entryDate, $departureDate) {
                return $query->whereBetween('entry_date', [$entryDate, $departureDate])
                    ->orWhereBetween('entry_date', [$entryDate, $departureDate]);
            })
        ])->first();
    }

    private function getSource($sourceName)
    {
        if (!$sourceName)
            return Source::first();

        return Source::firstOrCreate(['name' => $sourceName]);
    }
}
