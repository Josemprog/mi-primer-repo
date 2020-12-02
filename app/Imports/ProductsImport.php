<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product = Product::find($row['id']);
        return $product ? $this->updateProduct($product, $row) : $this->createProduct($row);
    }

    public function createProduct($row)
    {
        return new Product([
           'id'            => $row['id'],
           'brand'         => $row['brand'],
           'name'          => $row['name'],
           'price'         => $row['price'],
           'quantity'      => $row['quantity'],
           'description'   => $row['description'],
           'image'         => $row['image'],
           'enabled'       => $row['enabled'],
        ]);
    }

    public function updateProduct(Product $product, $row)
    {
        $product->update($row);
        return $product;
    }
}
