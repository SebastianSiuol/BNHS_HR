<?php

namespace App\Exports;

use App\Models\Faculty;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class CivilAndWorkSheetExport implements FromView, WithEvents
{
    public function view(): View
    {
        $faculty = Faculty::find(1);

        return view('export.civil-work', compact('faculty'));
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
            18,
            15,
            25.5,
            27, //05
            27,
            27,
            27,
            27,
            27, //10
            27,
            12,
            18,
            12,
            18, //15
            15,
            18.75,
            24,
            24,
            24, //20
            24,
            24,
            24,
            24,
            24, //25
            24,
            24,
            24,
            24,
            24, //30
            24,
            24,
            24,
            24,
            24, //35
            24,
            24,
            24,
            24,
            24, //40
            24,
            24,
            24,
            24,
            24, //45
            9.75,
            27.75
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
            'B' => 5.57,
            'C' => 9,
            'D' => 9.86,
            'E' => 6.29,
            'F' => 12.14,
            'G' => 6.14,
            'H' => 6.14,
            'I' => 16.86,
            'J' => 7.71,
            'K' => 8.14,
            'L' => 10.71,
            'M' => 6.43,
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
            'A2:M2' => [
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
            'A13:M13' => [
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
            'A14:M14' => [
                'font' => [
                    'size' => 10,
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

            'A12:M12' => [
                'font' => [
                    'size' => 8,
                    'bold' => true,
                    'italic' => true,
                    'color' => [
                        'argb' => 'FF0000'
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            'A46:M46' => [
                'font' => [
                    'size' => 8,
                    'bold' => true,
                    'italic' => true,
                    'color' => [
                        'argb' => 'FF0000'
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],



            'A47:C47' => [
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
            'I47' => [
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

        ];

        foreach ($customStyles as $range => $style) {
            $sheet->getStyle($range)->applyFromArray($style);
        }

        // Apply colors
        $this->applyColors($sheet, [
            ['range' => 'A2:M2', 'color' => '969696'],
            ['range' => 'A13:M14', 'color' => '969696'],
            ['range' => 'A3:M4', 'color' => 'EAEAEA'],
            ['range' => 'A12:M12', 'color' => 'EAEAEA'],
            ['range' => 'A46:M46', 'color' => 'EAEAEA'],
            ['range' => 'A15:M17', 'color' => 'EAEAEA'],

            ['range' => 'A47:C47', 'color' => 'EAEAEA'],
            ['range' => 'I47', 'color' => 'EAEAEA'],

        ]);

        // Apply borders
        $this->applyBorders($sheet, [
            //  Civil Service ELigibility
            ['range' => 'A2:M47', 'border' => Border::BORDER_THICK],
            ['range' => 'A3:E4', 'border' => null],
            ['range' => 'F3:F4', 'border' => null],
            ['range' => 'G3:H4', 'border' => null],
            ['range' => 'I3:K4', 'border' => null],
            ['range' => 'L3:M3', 'border' => null],
            ['range' => 'L4', 'border' => null],
            ['range' => 'M4', 'border' => null],

            // Work Experience
            ['range' => 'A13:M14', 'border' => Border::BORDER_THICK],
            ['range' => 'A15:C16', 'border' => null],
            ['range' => 'A17:B17', 'border' => null],
            ['range' => 'C17:C17', 'border' => null],
            ['range' => 'D15:F17', 'border' => null],
            ['range' => 'G15:I17', 'border' => null],
            ['range' => 'J15:J17', 'border' => null],
            ['range' => 'K15:K17', 'border' => null],
            ['range' => 'L15:L17', 'border' => null],
            ['range' => 'M15:M17', 'border' => null],

            ['range' => 'A46:M46', 'border' => null],
            ['range' => 'A47:C47', 'border' => null],
            ['range' => 'D47:H47', 'border' => null],
            ['range' => 'I47', 'border' => null],
            ['range' => 'J47:M47', 'border' => null],

            // Fields
            ['range' => 'M15:M17', 'border' => null],



        ]);

        $this->applyAllBorders($sheet, [
            ['range' => 'A5:M12', 'border' => null],
            ['range' => 'L5:M11', 'border' => null],
            ['range' => 'F5:F11', 'border' => null],
            ['range' => 'C18:C45', 'border' => null],
            ['range' => 'A18:M47', 'border' => null],
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
