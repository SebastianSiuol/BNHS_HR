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

class FacultiesExport implements FromView, WithEvents
{
    /**
     * Return the view used for export.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        $faculty = Faculty::find(1);
        return view('export.pds', [
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
                $this->setCellValues($sheet);
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
            2.25,
            28.5,
            36,
            21.75,
            11.25,
            0,
            12.75,
            0,
            16.5,
            22.5,
            22.5,
            22.5,
            24, //13
            12,
            24.75,
            24.75,
            15.75,
            9,
            5.25,
            9.75, //20
            9,
            15.75,
            8.25,
            22.5,
            15.75, //25
            9,
            15.75,
            9,
            15.75,
            9.75, //30
            24.75,
            24.75,
            24.75,
            24.75,
            16.5, //35
            21,
            21,
            21,
            21,
            21, //40
            21,
            21,
            21,
            21,
            21, //45
            21,
            21,
            21,
            21,
            15.75, //50
            14.25,
            19.5,
            14.25,
            24,
            24, //55
            24,
            24,
            24,
            24,
            12, //60
            27.75,
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
            'A' => 2,
            'B' => 12.86,
            'C' => 5.29,
            'D' => 18,
            'E' => 5.57,
            'F' => 4.86,
            'G' => 7.86,
            'H' => 9.29,
            'I' => 8.71,
            'J' => 7,
            'K' => 7,
            'L' => 10.71,
            'M' => 8.14,
            'N' => 8.86,
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
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_TOP,
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
            'A2' => [
                'font' => [
                    'name' => 'Calibri',
                    'size' => 11,
                    'bold' => true,
                    'italic' => true,
                ],
                'alignment' => [
                    'wrapText' => true,
                ],
            ],
            'A3' => [
                'font' => [
                    'name' => 'Arial Black',
                    'size' => 22,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],
            'A4:A5' => [
                'font' => [
                    'name' => 'Arial',
                    'bold' => true,
                    'italic' => true,
                ],
            ],
            'A7' => [
                'font' => [
                    'size' => 8,
                ],
            ],
            'K7' => [
                'font' => [
                    'bold' => false,
                ],
            ],
            'A9' => [
                'font' => [
                    'size' => 11,
                    'bold' => true,
                    'italic' => true,
                    'color' => [
                        'argb' => 'FFFFFF',
                    ],
                ],
            ],
            'A35' => [
                'font' => [
                    'size' => 11,
                    'bold' => true,
                    'italic' => true,
                    'color' => [
                        'argb' => 'FFFFFF',
                    ],
                ],
            ],
            'A50' => [
                'font' => [
                    'size' => 11,
                    'bold' => true,
                    'italic' => true,
                    'color' => [
                        'argb' => 'FFFFFF',
                    ],
                ],
            ],
            'A61:C61' => [
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
            'J61:K61' => [
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
            'A60:N60' => [
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
        ];

        foreach ($customStyles as $range => $style) {
            $sheet->getStyle($range)->applyFromArray($style);
        }

        // Apply colors
        $this->applyColors($sheet, [
            ['range' => 'A10:C61', 'color' => 'EAEAEA'],
            ['range' => 'A51:N53', 'color' => 'EAEAEA'],
            ['range' => 'G13:I16', 'color' => 'EAEAEA'],
            ['range' => 'G17:H24', 'color' => 'EAEAEA'],
            ['range' => 'G25:H31', 'color' => 'EAEAEA'],
            ['range' => 'G32:H32', 'color' => 'EAEAEA'],
            ['range' => 'G33:H33', 'color' => 'EAEAEA'],
            ['range' => 'G34:H34', 'color' => 'EAEAEA'],
            ['range' => 'G37:H37', 'color' => 'EAEAEA'],
            ['range' => 'G44:H44', 'color' => 'EAEAEA'],
            ['range' => 'I36:N36', 'color' => 'EAEAEA'],
            ['range' => 'J61:K61', 'color' => 'EAEAEA'],
            ['range' => 'K7', 'color' => '969696'],
            ['range' => 'A9:N9', 'color' => '969696'],
            ['range' => 'A35:N35', 'color' => '969696'],
            ['range' => 'A50:N50', 'color' => '969696'],
        ]);

        // Apply borders
        $this->applyBorders($sheet, [
            ['range' => 'A2:N61', 'border' => Border::BORDER_THICK],
            ['range' => 'K7', 'border' => null],
            ['range' => 'L7:N7', 'border' => null],
            ['range' => 'D10:N10', 'border' => null],
            ['range' => 'A10:C12', 'border' => null],
            ['range' => 'D11:K11', 'border' => null],
            ['range' => 'D12:N12', 'border' => null],
            ['range' => 'L11:N11', 'border' => null],
            ['range' => 'A15:C15', 'border' => null],
            ['range' => 'D13:F14', 'border' => null],
            ['range' => 'J13:N16', 'border' => null],
            ['range' => 'G13:I16', 'border' => null],
            ['range' => 'G13:I16', 'border' => null],
            ['range' => 'A16:C16', 'border' => null],
            ['range' => 'A17:C21', 'border' => null],
            ['range' => 'A22:C23', 'border' => null],
            ['range' => 'A24:C24', 'border' => null],
            ['range' => 'A25:C26', 'border' => null],
            ['range' => 'A27:C28', 'border' => null],
            ['range' => 'A29:C30', 'border' => null],
            ['range' => 'A31:C31', 'border' => null],
            ['range' => 'A32:C32', 'border' => null],
            ['range' => 'A33:C33', 'border' => null],
            ['range' => 'A34:C34', 'border' => null],

            ['range' => 'A9:N9', 'border' => Border::BORDER_THICK],
            ['range' => 'A35:N35', 'border' => Border::BORDER_THICK],
            ['range' => 'A50:N50', 'border' => Border::BORDER_THICK],

            // Residential Address
            ['range' => 'G17:H24', 'border' => null],
            ['range' => 'I17:K17', 'border' => null],
            ['range' => 'I18:N18', 'border' => null],
            ['range' => 'I19:K20', 'border' => null],
            ['range' => 'I21:N21', 'border' => null],
            ['range' => 'I22:K22', 'border' => null],
            ['range' => 'I23:N23', 'border' => null],
            ['range' => 'I24:N24', 'border' => null],

            // Permanent
            ['range' => 'G25:H31', 'border' => null],
            ['range' => 'I25:K25', 'border' => null],
            ['range' => 'I26:N26', 'border' => null],
            ['range' => 'I27:K27', 'border' => null],
            ['range' => 'I28:N28', 'border' => null],
            ['range' => 'I29:K29', 'border' => null],
            ['range' => 'I30:N30', 'border' => null],
            ['range' => 'I31:N31', 'border' => null],

            ['range' => 'G32:H32', 'border' => null],
            ['range' => 'G33:H33', 'border' => null],
            ['range' => 'G34:H34', 'border' => null],
            ['range' => 'I32:N32', 'border' => null],
            ['range' => 'I33:N33', 'border' => null],
            ['range' => 'I34:N34', 'border' => null],

            // Spouse Fields
            ['range' => 'A36:C38', 'border' => null],
            ['range' => 'D36:H36', 'border' => null],
            ['range' => 'D37:F37', 'border' => null],
            ['range' => 'G37:H37', 'border' => null],
            ['range' => 'D38:H38', 'border' => null],

            // Side Headers
            ['range' => 'A39:C39', 'border' => null],
            ['range' => 'A40:C40', 'border' => null],
            ['range' => 'A41:C41', 'border' => null],
            ['range' => 'A42:C42', 'border' => null],
            ['range' => 'A43:C45', 'border' => null],
            ['range' => 'A46:C49', 'border' => null],

            // Child Headers
            ['range' => 'I36:L36', 'border' => null],
            ['range' => 'M36:N36', 'border' => null],

            // Educational Background
            ['range' => 'A51:C53', 'border' => null],
            ['range' => 'D51:F53', 'border' => null],
            ['range' => 'G51:I53', 'border' => null],
            ['range' => 'J51:K52', 'border' => null],
            ['range' => 'L51:L53', 'border' => null],
            ['range' => 'J53', 'border' => null],
            ['range' => 'K53', 'border' => null],
            ['range' => 'M51:M53', 'border' => null],
            ['range' => 'N51:N53', 'border' => null],
            ['range' => 'A54:C54', 'border' => null],
            ['range' => 'A55:C55', 'border' => null],
            ['range' => 'A56:C56', 'border' => null],
            ['range' => 'A57:C57', 'border' => null],
            ['range' => 'A58:C58', 'border' => null],
            ['range' => 'A59:C59', 'border' => null],
            ['range' => 'A60:N60', 'border' => null],
            ['range' => 'A61:C61', 'border' => null],
            ['range' => 'D61:I61', 'border' => null],
            ['range' => 'J61:K61', 'border' => null],
            ['range' => 'L61:N61', 'border' => null],
        ]);

        $this->applyAllBorders($sheet, [
            ['range' => 'D15:F34', 'border' => null],
            ['range' => 'D36:N49', 'border' => null],
            ['range' => 'D51:N59', 'border' => null],
            ['range' => 'D51:N59', 'border' => null],

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
     * Set specific cell values.
     *
     * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet
     */
    private function setCellValues($sheet): void
    {
        $sheet->setCellValue('A2', "CS Form No. 212 \r\n Revised 2017");
        $sheet->getStyle('A2')->getAlignment()->setWrapText(true);

        $sheet->setCellValue('B13', "DATE OF BIRTH\r\n(mm/dd/yyyy)");
        $sheet->getStyle('B13')->getAlignment()->setWrapText(true);
    }

    /**
    * @param \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet The worksheet object to apply the styles.
    * @param array $ranges An array of configurations for coloring ranges. Each configuration must include:
    *     - 'range': A string specifying the cell range (e.g., 'A1:B10').
    *     - 'color': A string specifying the ARGB color (e.g., 'FFFF0000' for red).
    * @return void
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
