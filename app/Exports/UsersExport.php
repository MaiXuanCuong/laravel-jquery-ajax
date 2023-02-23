<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        return User::query()->select(['id', 'name', 'email', 'phone', 'gender', 'birthday']);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Gender',
            'Birthday',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->phone,
            $user->gender,
            $user->birthday,
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
                $event->sheet->setTitle('Users');
                $event->sheet->setAutoSize(true);
            },
        ];
    }
}
