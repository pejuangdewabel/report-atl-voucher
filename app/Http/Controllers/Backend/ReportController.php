<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Model\YPOS;
use App\Model\YPOS_DETAIL_VOUCHER;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function reportATL()
    {
        $dateStart = null;
        $dateFinish = null;
        $data = array();
        $countData = 0;

        return view('report.index', compact('dateStart', 'dateFinish', 'data', 'countData'));
    }
    public function filterReport(Request $request)
    {
        $dateStart = $request->dateStart;
        $dateFinish = $request->dateFinish;
        $data = DB::table('y_pos')
            ->join('y_pos_detail_voucher', 'y_pos.strukno', '=', 'y_pos_detail_voucher.strukno')
            ->whereDate('strukdate', '>=', $dateStart)
            ->whereDate('strukdate', '<=', $dateFinish)
            ->get();
        $countData = DB::table('y_pos')
            ->join('y_pos_detail_voucher', 'y_pos.strukno', '=', 'y_pos_detail_voucher.strukno')
            ->whereDate('strukdate', '>=', $dateStart)
            ->whereDate('strukdate', '<=', $dateFinish)
            ->count();
        return view('report.index', compact('dateStart', 'dateFinish', 'data', 'countData'));
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new ReportExport($request->dateStart, $request->dateFinish), $request->dateStart . '-' . $request->dateFinish . ' Report.xlsx');
    }
}
