<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StayExport implements WithHeadings, FromArray, ShouldAutoSize
{
    public function headings(): array
    {
        return [
            'Nome',
            'RG',
            'Data de nascimento',
            'Telefone 1',
            'Cidade',
            'Tipo',
            'Origem',
            'Entrada',
            'Saída',
        ];
    }

    public function array(): array
    {
        return [
          [
              'João Carvalho',
              '26.769.764-8',
              '01/01/1980',
              '(42) 99999-9999',
              'Guarapuava',
              'Acompanhante',
              'Hospital São Vicente',
              '01/01/2020',
              '06/01/2020',
          ],
          [
              'Maria Conceição',
              '40.369.584-3',
              '17/06/1969',
              '(42) 98456-9999',
              'Pinhão',
              'Paciente',
              'Hospital Santa Tereza',
              '22/10/2020',
              '28/10/2020',
          ],
        ];
    }
}
