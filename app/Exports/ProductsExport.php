<?php

namespace App\Exports;

use App\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class ProductsExport implements FromQuery, ShouldQueue
{
    use Exportable;

    public function query()
    {
        return Product::query();
    }
}