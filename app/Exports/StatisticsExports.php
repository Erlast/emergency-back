<?php

namespace App\Exports;

use App\Models\CartridgeHistory;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class StatisticsExports implements FromQuery, WithMapping, WithHeadings
{

    use Exportable;

    private $startDate;
    private $endDate;

    public function __construct($request)
    {
        $this->startDate = $request->get('startDate') ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = $request->get('endDate') ?? Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function query()
    {

        return CartridgeHistory::query()
            ->select('cartridge_id')
            ->addCartStorage()
            ->range($this->startDate, $this->endDate)
            ->groupBy('cartstorages.id_name')
            ->orderBy('cartridge_id');
    }

    public function headings(): array
    {
        return [
            'Картридж',
            'Модель',
            'С заправки',
            'На заправку',
            'Из отдела',
            'В отдел',
            'На складе',
        ];
    }

    public function map($row): array
    {

        return [
            $row->cartridge->sh_code,
            $row->cartridge->cartName->name . " " . $row->cartridge->printName->name,
            $row->getOnFill($this->startDate, $this->endDate),
            $row->getFromFill($this->startDate, $this->endDate),
            $row->getToDepartment($this->startDate, $this->endDate),
            $row->getFromDepartment($this->startDate, $this->endDate),
            $row->onStorage($row->cartridge->id_name, $this->endDate),

        ];
    }
}
