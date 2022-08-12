<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded=[];

    public function subCats(){
        return $this->hasMany(Subcat::class);
    }
}
