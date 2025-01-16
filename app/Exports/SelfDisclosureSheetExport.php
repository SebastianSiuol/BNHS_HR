<?php

namespace App\Exports;

use App\Models\Faculty;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class SelfDisclosureSheetExport implements FromView
{
    public function view(): View
    {
        // Add data logic here, e.g., fetch additional data
        $data = [
            ['Name', 'Value'],
            ['Data 1', 100],
            ['Data 2', 200],
        ];

        return view('export.self-disclosure', ['data' => $data]);
    }
}
