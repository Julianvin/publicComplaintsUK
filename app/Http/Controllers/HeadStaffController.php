<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\ReportResponChart;
use App\Models\User;
use App\Models\Staff_provinces;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class HeadStaffController extends Controller
{
    //
    public function index(ReportResponChart $chart)
    {
        $chartInstance = $chart->build(); // Memanggil chart yang sudah dibuat
        return view('headstaff.index_headStaff', ['chart' => $chartInstance]);
    }

    public function createAcc()
    {
        $staffUsers = User::where('role', 'STAFF')->get();
        return view('headstaff.createAcc', compact('staffUsers'));
    }

    public function storeAcc(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Mendapatkan data provinsi dari akun HEAD_STAFF yang sedang login
        $headStaff = Auth::user(); // Asumsikan Auth sudah diatur
        if ($headStaff->role !== 'HEAD_STAFF') {
            return redirect()->back()->with('failed', 'tidak ada akses.');
        }

        $province = Staff_provinces::where('user_id', $headStaff->id)->value('province');

        // Pastikan data provinsi tersedia
        if (!$province) {
            return redirect()->back()->with('failed', 'Province data not found.');
        }

        // Membuat akun di tabel users
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'STAFF',
        ]);

        // Membuat data di tabel staff_provinces
        Staff_provinces::create([
            'user_id' => $user->id,
            'province' => $province,
        ]);

        // Response sukses menggunakan session flash message
        return redirect()->back()->with('success', 'Account successfully created.');
    }

    public function destroyAcc($id)
    {
        // Validasi bahwa yang mengakses adalah HEAD_STAFF
        $headStaff = Auth::user(); // Asumsikan Auth sudah diatur
        if ($headStaff->role !== 'HEAD_STAFF') {
            return redirect()->back()->with('failed', 'Unauthorized access.');
        }

        // Cari user berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('failed', 'User not found.');
        }

        // Pastikan user yang dihapus adalah STAFF
        if ($user->role !== 'STAFF') {
            return redirect()->back()->with('failed', 'Only STAFF accounts can be deleted.');
        }
        $user->delete();
        return redirect()->back()->with('success', 'Account successfully deleted.');
    }
}
