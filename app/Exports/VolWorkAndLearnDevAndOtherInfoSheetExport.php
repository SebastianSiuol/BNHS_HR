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

class VolWorkAndLearnDevAndOtherInfoSheetExport implements FromView, WithEvents
{
    public function view(): View
    {
        $faculty = Faculty::find(1);

        return view('export.volwork-learndev-otherinfo', [
            'faculty' => $faculty,
        ]);
    }


    /**
     * Register events for styling the exported sheet.
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->setShowGridlines(false);

                $this->setRowHeights($sheet);
                $this->setColumnWidths($sheet);
                $this->applyDefaultStyles($sheet);
                $this->applyCustomStyles($sheet);
                // $this->setCellValues($sheet);
            },
        ];
    }

    /**
     * Set custom row heights.
     *
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
     */
    private function setRowHeights($sheet): void
    {
        $rowHeights = [
            3, //01
            22.5,
            15,
            11.25,
            13.5, //5
            27.75,
            27.75,
            27.75,
            27.75,
            27.75, //10
            27.75,
            27.75,
            11.25,
            18,
            15.75, //15
            18,
            25.5,
            13.5,
            24.75,
            24.75, //20
            24.75,
            24.75,
            24.75,
            24.75,
            24.75, //25
            24.75,
            24.75,
            24.75,
            24.75,
            24.75, //30
            24.75,
            24.75,
            24.75,
            24.75,
            24.75, //35
            24.75,
            24.75,
            12.75,
            22.5,
            33.75, //40
            22.5,
            22.5,
            22.5,
            22.5,
            22.5, //45
            18,
            18,
            11.25,
            28.5, //49

        ];

        foreach (range(1, 62) as $rowIndex) {
            $sheet->getRowDimension($rowIndex)->setRowHeight($rowHeights[$rowIndex - 1] ?? 15);
        }
    }

    /**
     * Set column widths.
     *
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
     */
    private function setColumnWidths($sheet): void
    {
        $colWidths = [
            'A' => 4,
            'B' => 29.86,
            'C' => 2.43,
            'D' => 20,
            'E' => 9.57,
            'F' => 9.43,
            'G' => 9.43,
            'H' => 9.14,
            'I' => 2.29,
            'J' => 3.86,
            'K' => 24.29,
        ];

        foreach ($colWidths as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }
    }




    /**
     * Apply default styles to the sheet.
     *
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
     */
    private function applyDefaultStyles($sheet): void
    {
        $defaultStyles = [
            'font' => [
                'name' => 'Arial Narrow',
                'size' => 8,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_TOP,
                'wrapText' => true,
            ],
        ];

        $sheet->getStyle('A1:Z100')->applyFromArray($defaultStyles);
    }


    /**
     * Apply custom styles to specific cells or ranges.
     *
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
     */
    private function applyCustomStyles($sheet): void
    {
        $customStyles = [
            'A2:K2' => [
                'font' => [
                    'size' => 11,
                    'bold' => true,
                    'italic' => true,
                    'color' => [
                        'argb' => 'FFFFFF'
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ],

            'A14:K14' => [
                'font' => [
                    'size' => 11,
                    'bold' => true,
                    'italic' => true,
                    'color' => [
                        'argb' => 'FFFFFF'
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ],
            'A39:K39' => [
                'font' => [
                    'size' => 11,
                    'bold' => true,
                    'italic' => true,
                    'color' => [
                        'argb' => 'FFFFFF'
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ],
            'A15:K15' => [
                'font' => [
                    'bold' => true,
                    'italic' => true,
                    'color' => [
                        'argb' => 'FFFFFF'
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ],

            'A13:K13' => [
                'font' => [
                    'bold' => true,
                    'italic' => true,
                    'color' => [
                        'argb' => 'FF0000'
                    ]
                ],
            ],
            'A38:K38' => [
                'font' => [
                    'bold' => true,
                    'italic' => true,
                    'color' => [
                        'argb' => 'FF0000'
                    ]
                ],
            ],
            'A48:K48' => [
                'font' => [
                    'bold' => true,
                    'italic' => true,
                    'color' => [
                        'argb' => 'FF0000'
                    ]
                ],
            ],

            'A49:B49' => [
                'font' => [
                    'size' => 11,
                    'bold' => true,
                    'italic' => true,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],

            'G49:H49' => [
                'font' => [
                    'size' => 11,
                    'bold' => true,
                    'italic' => true,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            'A3:K5' => [
                'font' => [
                    'bold' => true,
                ]
            ],
            'A16:K18' => [
                'font' => [
                    'bold' => true,
                ]
            ],
            'A40:K40' => [
                'font' => [
                    'bold' => true,
                ]
            ],
        ];

        foreach ($customStyles as $range => $style) {
            $sheet->getStyle($range)->applyFromArray($style);
        }

        // Apply colors
        $this->applyColors($sheet, [
            ['range' => 'A2:K2', 'color' => '969696'],
            ['range' => 'A14:K15', 'color' => '969696'],
            ['range' => 'A39:K39', 'color' => '969696'],

            ['range' => 'A3:K5', 'color' => 'EAEAEA'],
            ['range' => 'A13:K13', 'color' => 'EAEAEA'],
            ['range' => 'A16:K18', 'color' => 'EAEAEA'],
            ['range' => 'A38:K38', 'color' => 'EAEAEA'],
            ['range' => 'A40:K40', 'color' => 'EAEAEA'],
            ['range' => 'A48:K48', 'color' => 'EAEAEA'],

            ['range' => 'A49:B49', 'color' => 'EAEAEA'],
            ['range' => 'G49:H49', 'color' => 'EAEAEA'],

        ]);

        // Apply borders
        $this->applyBorders($sheet, [
            ['range' => 'A2:K2', 'border' => null],

            ['range' => 'A3:D5', 'border' => null],
            ['range' => 'E3:F4', 'border' => null],
            ['range' => 'G3:G5', 'border' => null],
            ['range' => 'H3:K5', 'border' => null],
            ['range' => 'E5:E5', 'border' => null],
            ['range' => 'F5:F5', 'border' => null],

            ['range' => 'A13:K13', 'border' => null],
            ['range' => 'A14:K15', 'border' => null],

            ['range' => 'A16:D18', 'border' => null],
            ['range' => 'E16:F17', 'border' => null],
            ['range' => 'G16:G18', 'border' => null],
            ['range' => 'H16:H18', 'border' => null],
            ['range' => 'I16:K18', 'border' => null],
            ['range' => 'E18:E18', 'border' => null],
            ['range' => 'F18:F18', 'border' => null],

            ['range' => 'A38:K38', 'border' => null],
            ['range' => 'A39:K39', 'border' => null],

            ['range' => 'A40:B40', 'border' => null],
            ['range' => 'C40:H40', 'border' => null],
            ['range' => 'I40:K40', 'border' => null],
        ]);

        $this->applyAllBorders($sheet, [
            ['range' => 'A6:K12', 'border' => null],
            ['range' => 'A19:K37', 'border' => null],
            ['range' => 'A41:K49', 'border' => null],
        ]);
    }


    /**
     * Apply borders to specified ranges with optional colors.
     *
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
     * @param array $ranges
     */
    private function applyBorders($sheet, array $ranges): void
    {
        foreach ($ranges as $borderConfig) {
            $range = $borderConfig['range'];
            $border = $borderConfig['border'];

            $borderStyle = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => $border ? $border : Border::BORDER_THIN,
                    ],
                ],
            ];

            $sheet->getStyle($range)->applyFromArray($borderStyle);
        }
    }

    /**
     * Apply all borders to a specified range.
     *
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
     * @param array $ranges
     */
    private function applyAllBorders($sheet, array $ranges): void
    {
        foreach ($ranges as $borderConfig) {
            $range = $borderConfig['range'];
            $border = $borderConfig['border'];

            $borderStyle = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => $border ? $border : Border::BORDER_THIN,
                    ],
                ],
            ];
            $sheet->getStyle($range)->applyFromArray($borderStyle);
        }
    }

    /**
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet The worksheet object to apply the styles.
     * @param array $ranges
     */
    private function applyColors($sheet, array $ranges): void
    {
        foreach ($ranges as $colorConfig) {
            $range = $colorConfig['range'];
            $color = $colorConfig['color'];

            if (!$color) {
                continue; // Skip if no color is specified.
            }

            $colorStyle = [
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => $color,
                    ],
                ],
            ];

            // Apply the color to the specified range.
            $sheet->getStyle($range)->applyFromArray($colorStyle);
        }
    }
}
