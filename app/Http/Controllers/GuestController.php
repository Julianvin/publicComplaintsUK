<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = Report::with('user');
        if ($request->province) {
            $query->where('province', $request->province);
        }
        $reports = $query->latest()->paginate(10);

        return view('guest.index_guest', compact('reports'));
    }

    public function createReport()
    {
        return view('guest.create_report');
    }

    public function storeReport(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'type' => 'required|in:KEJAHATAN,PEMBANGUNAN,SOSIAL',
            'detail' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'konfirmasi' => 'accepted',
        ], [
            'provinsi.required' => 'Provinsi wajib diisi.',
            'kota.required' => 'Kota wajib diisi.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kelurahan.required' => 'Kelurahan wajib diisi.',
            'type.required' => 'Jenis laporan wajib dipilih.',
            'type.in' => 'Jenis laporan harus salah satu dari: Kejahatan, Pembangunan, atau Sosial.',
            'detail.required' => 'Detail laporan wajib diisi.',
            'gambar.image' => 'File gambar harus dalam format gambar.',
            'gambar.mimes' => 'Gambar harus memiliki format jpeg, png, jpg, gif, atau svg.',
            'gambar.max' => 'Ukuran gambar maksimal 10MB.',
            'konfirmasi.accepted' => 'Anda harus bertanggung jawab atas informasi ini.',
        ]);

        // Menyimpan gambar yang di-upload ke folder 'storage/app/public/images/reports'
        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/assets/images/reports/', $filename);

        Report::create([
            'user_id' => auth()->user()->id,
            'description' => $request->detail,
            'type' => $request->type,
            'province' => $request->provinsi,
            'regency' => $request->kota,
            'subdistrict' => $request->kecamatan,
            'village' => $request->kelurahan,
            'voting' => json_encode([]),
            'viewers' => 0,
            'image' => $filename,
            'statement' => $request->has('konfirmasi') ? true : false,
        ]);

        // Redirect ke halaman yang sesuai atau memberikan respon sukses
        return redirect()->route('report_me')->with('success', 'Laporan berhasil dikirim dan sesegera mungkin di proses.');
    }

    public function deleteReport($id)
    {
        $report = Report::findorFail($id);

        if ($report->Response) {
            return redirect()->route('report_me')->with('error', 'Laporan ini sedang diproses. Tidak bisa di hapus.');
        }

        if ($report->image && Storage::exists('public/assets/images/reports/' . $report->image)) {
            Storage::delete('public/assets/images/reports/' . $report->image);
        }

        $report->delete();
        return redirect()->route('report_me')->with('success', 'Laporan berhasil dihapus.');
    }


    public function vote(Request $request)
    {
        $report = Report::find($request->report_id);

        if (!$report) {
            return response()->json(['success' => false, 'message' => 'Laporan tidak ditemukan.']);
        }

        $userId = $request->user_id;
        $voting = json_decode($report->voting, true) ?? [];

        if (in_array($userId, $voting)) {
            // Hapus ID user dari daftar voting
            $voting = array_filter($voting, function ($id) use ($userId) {
                return $id != $userId;
            });
            $report->voting = json_encode(array_values($voting)); // Reindex array
            $report->save();

            return response()->json(['success' => true, 'message' => 'Vote Anda telah dibatalkan.', 'voting_count' => count($voting)]);
        }

        // Tambahkan ID user ke daftar voting
        $voting[] = $userId;
        $report->voting = json_encode($voting);
        $report->save();

        return response()->json(['success' => true, 'message' => 'Vote Anda berhasil ditambahkan.', 'voting_count' => count($voting)]);
    }




    public function monitoringReport()
    {
        $reports = Report::with(['Response', 'response.progress'])
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();
        // return $reports;
        return view('guest.show_report', compact('reports'));
    }


    public function comment($reportId)
    {
        $report = Report::findOrFail($reportId);
        $comments = $report->Comment()->latest()->get();
        $report->increment('viewers');

        // Kirim data ke view
        return view('guest.comment_report', compact('report', 'comments'));
    }


    public function storeComment(Request $request, $reportId)
    {
        // Validasi input
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $report = Report::findOrFail($reportId);
        $comment = Comment::create([
            'report_id' => $report->id,
            'user_id' => auth()->user()->id,
            'comment' =>  $validated['comment'],
        ]);
        return redirect()->route('report_comment', $report->id)->with('success', 'Komentar berhasil ditambahkan.');
    }
}
