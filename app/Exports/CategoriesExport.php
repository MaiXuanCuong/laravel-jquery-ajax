<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CategoriesExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Category::query()->select(['id', 'name', 'description']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Description',
        ];
    }

    public function map($category): array
    {
        return [
            $category->id,
            $category->name,
            $category->description,
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
                $event->sheet->setTitle('Categories');
                $event->sheet->setAutoSize(true);
            },
        ];
    }
}

