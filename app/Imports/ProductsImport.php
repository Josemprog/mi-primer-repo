<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
           'brand'       => $row[1],
           'name'       => $row[2],
           'price'       => $row[3],
           'quantity'       => $row[4],
           'description'       => $row[5],
           'image'       => $row[6],
           'enabled'       => $row[7],
        ]);
    }
}
