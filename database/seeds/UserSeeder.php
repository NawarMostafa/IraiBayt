<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

    \App\Country::create([
        'name'=>'العراق',

    ]);

    \App\City::create([
'name'=>'بغداد',
        'country_id'=>1
    ]);
        \App\City::create([
            'name'=>'الموصل',
            'country_id'=>1
        ]);
        \App\City::create([
            'name'=>'صلاح الدين',
            'country_id'=>1
        ]);
        \App\City::create([
            'name'=>'ديالي',
            'country_id'=>1
        ]);

        \App\Region::create([
            'name'=>'الكرخ',
            'city_id'=>1,
            'country_id'=>1
        ]);
        \App\Category::create([
            'name'=>'عقارات للبيع',

        ]);
        \App\Category::create([
            'name'=>'عقارات للإيجار',

        ]);
        \App\Subcat::create([
            'name'=>'فلل للبيع',
            'type'=>'سكني',
            'category_id'=>1
        ]);
        \App\Subcat::create([
            'name'=>'فلل للإيجار',
            'type'=>'سكني',
            'category_id'=>2
        ]);
        \App\Currancy::create([
            'name'=>'دينار عراقي',
            'short_name'=>'IQD'
        ]);
        \App\Currancy::create([
            'name'=>'دولار أمريكي',
            'short_name'=>'USD'
        ]);
        \App\Currancy::create([
            'name'=>'ليرة تركية',
            'short_name'=>'TL'
        ]);

        \App\Material::create([
            'name'=>'ذهب',
            'short_name'=>'gold'
        ]);
        \App\Material::create([
            'name'=>'حديد',
            'short_name'=>'iron'
        ]);
        \App\Unit::create([
            'name'=>'متر مربع'
        ]);
        \App\Unit::create([
            'name'=>'دونم'
        ]);
    }
}
