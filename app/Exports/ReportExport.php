<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $dateStart;
    protected $dateFinish;

    public function __construct($dateStart, $dateFinish)
    {
        $this->dateStart = $dateStart;
        $this->dateFinish = $dateFinish;
    }

    public function collection()
    {
        $data = DB::table('y_pos')
            ->join('y_pos_detail_voucher', 'y_pos.strukno', '=', 'y_pos_detail_voucher.strukno')
            ->whereDate('strukdate', '>=', $this->dateStart)
            ->whereDate('strukdate', '<=', $this->dateFinish)
            ->select('voucherno', 'strukdate')
            ->get();
        return $data;
    }

    public function headings(): array
    {
        return [
            'Voucher',
            'Tanggal Struk',
        ];
    }
}
