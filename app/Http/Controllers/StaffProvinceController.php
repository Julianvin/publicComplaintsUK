<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Response;
use App\Models\Response_progress;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExcel;

class StaffProvinceController extends Controller
{
    //
    public function index(Request $request)
    {
        $province = auth()->user()->staff?->province;
        $order = $request->get('sort', 'desc');

        // Ambil report berdasarkan provinsi user dengan pengurutan jumlah vote
        $reports = Report::where('province', $province)
            ->get()
            ->sortBy(function ($report) {
                return count(json_decode($report->voting, true) ?? []);
            }, SORT_REGULAR, $order === 'desc')
            ->values(); //

        return view('staffProvince.index_staffProvince', compact('reports', 'order'));
    }

    // Method untuk ekspor berdasarkan Province
    public function exportByProvince()
    {
        $province = auth()->user()->staff?->province;

        return Excel::download(new ReportExcel(null, $province), 'report_' . $province . '.xlsx');
    }

    // Method untuk ekspor berdasarkan Tanggal
    public function exportByDate(Request $request)
    {
        $date = $request->input('date');

        return Excel::download(new ReportExcel($date), 'report_' . $date . '.xlsx');
    }

    public function storeResponse(Request $request)
    {
        $request->validate([
            'report_id' => 'required|exists:reports,id',
            'action' => 'required|in:REJECT,ON_PROCESS',
        ]);

        // Periksa apakah sudah ada response dengan action ON_PROCESS untuk report_id
        $existingResponse = Response::where('report_id', $request->report_id)
            ->where('response_status', 'ON_PROCESS')
            ->first();

        if ($request->action == 'ON_PROCESS') {
            if ($existingResponse) {
                return redirect()->route('staff_processed_report', ['report_id' => $request->report_id]);
            } else {
                Response::create([
                    'report_id' => $request->report_id,
                    'staff_id' => auth()->user()->id,
                    'response_status' => 'ON_PROCESS',
                ]);
                return redirect()->route('staff_processed_report', ['report_id' => $request->report_id]);
            }
        }

        Response::create([
            'report_id' => $request->report_id,
            'staff_id' => auth()->user()->id,
            'response_status' => $request->action,
        ]);

        return redirect()->back()->with('success', 'Respon berhasil disimpan!');
    }


    public function showProcessedReport($report_id)
    {
        $report = Report::with('Response', 'Response.Progres')
            ->whereHas('Response', function ($query) {
                $query->where('response_status', 'ON_PROCESS');
            })
            ->findOrFail($report_id);

        return view('staffProvince.respon_report', compact('report'));
    }


    public function store(Request $request, $id)
    {
        // Find the Response based on report_id
        $response = Response::where('report_id', $id)->first();

        if (!$response) {
            return redirect()->back()->with('error', 'Response not found');
        }

        $validated = $request->validate([
            'Response_progress' => 'required|string|max:1000'
        ]);

        // Create or update the response progress
        $responseProgress = Response_progress::firstOrNew([
            'response_id' => $response->id
        ]);

        // Add to histories
        $histories = $responseProgress->histories ?? [];
        $histories[] = [
            'description' => $validated['Response_progress'],
            'created_at' => now()->toDateTimeString()
        ];

        // Update histories field
        $responseProgress->histories = $histories;

        // Save the record
        $responseProgress->save();

        return redirect()->back()->with('success', 'Progress berhasil ditambahkan');
    }

    public function delete($id, $historyIndex)
    {
        // Ambil response terkait report ID
        $response = Response::where('report_id', $id)->first();
        if (!$response) {
            return redirect()->back()->with('error', 'Response not found');
        }

        // Ambil response progress terkait response ID
        $responseProgress = Response_progress::where('response_id', $response->id)->first();
        if (!$responseProgress) {
            return redirect()->back()->with('error', 'Response progress not found');
        }

        // Ambil histori yang ada pada progress
        $histories = $responseProgress->histories ?? [];

        // Periksa apakah historyIndex valid
        if (isset($histories[$historyIndex])) {
            // Hapus histori berdasarkan index
            unset($histories[$historyIndex]);

            // Reindex ulang array
            $responseProgress->histories = array_values($histories);

            // Simpan perubahan
            $responseProgress->save();

            return redirect()->back()->with('success', 'Progress history successfully deleted');
        } else {
            return redirect()->back()->with('error', 'Invalid history entry');
        }
    }
}
