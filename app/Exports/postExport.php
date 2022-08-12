<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use App\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Auth;

class PostExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        // return DB::table('posts')
        //     ->join('cities', 'posts.city_id', '=', 'cities.id')
        //     ->join('countries', 'posts.country_id', '=', 'countries.id')
        //     ->select('posts.*', 'cities.name', 'countries.name')
        //     ->get();
        // return Post::with(['country'=> function($query){
        //     // selecting fields from staff table
        //     $query->select(['countries.id','countries.name']);
        //   }])->get(['id','name','country_id']);

        // return DB::table('posts')
        // ->join('countries', 'countries.id', '=', 'posts.country_id')
        // ->get(array('posts.name','posts.country_id', 'countries.name'));
        return Post::get(['title','description','price','currancy_id','area','unit_id','bedroom','bathroom','payment','carage','num_car','floor'
        ,'num_floor','name','phone','created_at','updated_at']);
    }

    public function headings(): array
    {
        return [
            'العنوان',
            'التفاصيل',
            'السعر',
            'العملة',
            'المساحة',
            'وحدة القياس',
            'غرف النوم',
            'الحمامات',
            'طريقة الدفع',
            'الكراج',
            'عدد السيارات',
            'عدد الطوابق',
            'رقم الطابق',
            'الاسم',
            'الهاتف',
            'تاريخ الانشاء',
            'آخر تعديل',
        ];
    }

}