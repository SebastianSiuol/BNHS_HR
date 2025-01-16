<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\PersonalInformationSheetExport;
use App\Exports\CivilAndWorkSheetExport;
use App\Exports\VolWorkAndLearnDevAndOtherInfoSheetExport;

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
            new PersonalInformationSheetExport(),
            new CivilAndWorkSheetExport(),
            new VolWorkAndLearnDevAndOtherInfoSheetExport(),
            new SelfDisclosureSheetExport(),
        ];

        return $sheets;
    }
}