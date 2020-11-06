<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;

class ExportController extends Controller
{
    public function export(ProductsExport $productsExport)
    {
        return $productsExport->download('products.xlsx');
    }
}
