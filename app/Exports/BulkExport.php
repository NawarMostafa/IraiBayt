<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BulkExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        return User::get(['name','email','role','active','created_at','updated_at']);
    }

    public function headings(): array
    {
        return [
            'الاسم',
            'الايميل',
            'النوع',
            'الحالة',
            ' تاريخ الانشاء',
            'تاريخ التعديل ',
        ];
    }
}