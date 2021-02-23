<?php
namespace App\Exports;

use App\Person;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithHeadings;    
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

// WithDrawings
class PersonnelExport implements FromCollection,WithHeadings,WithStyles,WithMapping
{
    public function headings(): array
    {
        return [
                [
                'Rapid Pass. No',
                'First Name',
                'Middle Name',
                'Last Name',
                'Sex',
                'Birthdate',
                'Rapid Test Date',
                'Permanent Address',
                'Register Date',
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

        return Person::all(['rapid_pass_no', 'firstname', 'middlename', 'lastname', 'gender', 'date_of_birth', 'rapid_test_issued', 'address', 'created_at']);
    }

     /**
    * @var Invoice $invoice
    */
    public function map($person): array
    {
        return [
            $person->rapid_pass_no,
            $person->firstname,
            $person->middlename,
            $person->lastname,
            $person->gender,
            $person->date_of_birth,
            $person->rapid_test_issued,
            $person->address,
            $person->created_at->format('M d, Y  h:i:s A'),
        ];
    }
}