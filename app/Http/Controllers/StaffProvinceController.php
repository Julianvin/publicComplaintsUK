<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class StaffProvinceController extends Controller
{
    //
    public function index(Request $request)
    {
        $province = auth()->user()->staff?->province;
        $order = $request->get('order', 'desc');

        // Ambil report berdasarkan provinsi user dengan pengurutan jumlah vote
        $reports = Report::where('province', $province)
            ->get()
            ->sortBy(function ($report) {
                return count(json_decode($report->voting, true) ?? []);
            }, SORT_REGULAR, $order === 'desc');

        return view('staffProvince.index_staffProvince', compact('reports', 'order'));
    }
}
