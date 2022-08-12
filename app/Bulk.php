<?php
namespace App;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class Bulk extends FromCollection
{
    public function collection()
    {
        return User::all();
    }
}