<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        "section_id",
        "product_name",
        "created_by",
        "note"
    ];


    public function section(){
        return $this->hasOne(section::class,'id','section_id');
    }
}
