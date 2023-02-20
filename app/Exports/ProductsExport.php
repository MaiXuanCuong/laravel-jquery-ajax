<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductsExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Product::query()
        ->join('suppliers', 'suppliers.id', '=', 'products.supplier_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->select([
            'products.id',
            'products.name',
            'products.price',
            'products.quantity',
            'products.type_gender',
            'suppliers.name AS supplier_name',
            'categories.name AS category_name'
        ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Price',
            'Quantity',
            'Gender',
            'Suppliers',
            'Categories',
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->price,
            $product->quantity,
            $product->type_gender,
            $product->supplier_name,
            $product->category_name,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => '@',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->setTitle('Products');
                $event->sheet->setAutoSize(true);
            },
        ];
    }
}

