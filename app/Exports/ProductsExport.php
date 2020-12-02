<?php

namespace App\Exports;

use App\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromQuery, ShouldQueue, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Product::query();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'id',
            'brand',
            'name',
            'price',
            'quantity',
            'description',
            'image',
            'enabled'
        ];
    }
}
