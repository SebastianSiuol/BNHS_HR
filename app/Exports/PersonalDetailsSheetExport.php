<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\FacultiesExport;
use App\Exports\AdditionalDetailsExport;

class PersonalDetailsSheetExport implements FromArray, WithMultipleSheets
{
    protected $sheets;

    public function array(): array
    {
        return $this->sheets;
    }

    public function sheets(): array
    {
        $sheets = [
            new FacultiesExport(),
            new AdditionalDetailsExport(),
        ];

        return $sheets;
    }
}