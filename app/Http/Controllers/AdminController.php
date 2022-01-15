<?php

namespace App\Http\Controllers;

use App\Models\Absen_karyawan;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function karyawan()
    {
        $data_karyawan = Karyawan::all();
        return view('admin.karyawan', compact('data_karyawan'));
    }
    public function absen_karyawan()
    {
        $data_absen = Absen_karyawan::with('karyawan')->get();

        return view('admin.absen_karyawan', compact('data_absen'));
    }
    public function setting_user()
    {
        $data_karyawan = Karyawan::all();
        return view('admin.setting_user', compact('data_karyawan'));
    }
    public function laporan()
    {
        return view('admin.laporan');
    }
}
