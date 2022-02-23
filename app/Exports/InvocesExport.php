<?php

namespace App\Exports;

use App\Models\invoces;
use App\Models\Product;
use App\Models\section;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvocesExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($invoces)
    {
        $this->invoces = $invoces;

    }
    public function collection()
    {
       $invoces = $this->invoces;
        foreach ($invoces as $invoce) {
            $pro = Product::find($invoce->product_id);
            $sec = section::find($invoce->section_id);

            $invoce->product_id = $pro->product_name;
            $invoce->section_id = $sec->section_name;
        }

        return $invoces;
    }
    public function Headings():array{
        return[
            'Id',
            'invoces_number',
            'product_id',
            'section_id',
            'invoces_data',
            'due_data',
            'price_collection',
            'Price_Commission',
            'discount',
            'rote_vat',
            'value_vat',
            'total',
            'status',
            'user',
        ];
    }
}

/*

$invoces = invoces::select([
            'Id',
            'invoces_number',
            'product_id',
            'section_id',
            'invoces_data',
            'due_data',
            'price_collection',
            'Price_Commission',
            'discount',
            'rote_vat',
            'value_vat',
            'total',
            'status',
            'user',
        ])->get();

        foreach ($invoces as $invoce) {
            $pro=Product::find($invoce->product_id);
            $sec=section::find($invoce->section_id);

            $invoce->product_id = $pro->product_name;
            $invoce->section_id = $sec->section_name;
        }
        return $invoces;
*/
