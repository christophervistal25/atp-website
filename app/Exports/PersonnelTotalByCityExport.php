<?php
namespace App\Exports;

use App\City;
use App\Person;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithHeadings;    
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

// WithDrawings
class PersonnelTotalByCityExport implements FromCollection,WithHeadings,WithStyles,WithMapping
{
    public function headings(): array
    {
        return [
                [
                'Place',
                'No. of Personnel',
                ],
                []
            ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    // public function drawings()
    // {
    //     $drawing = new Drawing();
    //     $drawing->setName('Logo');
    //     $drawing->setDescription('This is my logo');
    //     $drawing->setPath('C:/xampp/htdocs/capitol_app/storage/app/public/images/app_logo.png');
    //     $drawing->setHeight(90);
    //     $drawing->setCoordinates('B1');

    //     return $drawing;
    //     return new Drawing();
    // }

    public function collection()
    {

        return City::with('people')->get();
    }

     /**
    * @var Invoice $invoice
    */
    public function map($city): array
    {
        return [
            $city->name . ' ' . 'Surigao del Sur',
            $city->people->count(),
        ];
    }
}