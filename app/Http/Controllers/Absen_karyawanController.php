<?php

namespace App\Http\Controllers;

use App\Models\Absen_karyawan;
use DateTime;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class Absen_karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'tanggal' => ['required'],
            'jam_masuk' => ['required'],
            'absen' => ['required'],
            'id_karyawan' => ['required'],
        ]);

        $date = new DateTime('now');
        $tanggal = $date->format('y-m-d');
        $time = $date->format('H:i:s');

        $absen = Absen_karyawan::where([
            ['id_karyawan', '=', auth()->user()->id],
            ['tanggal', '=', $tanggal]
        ])->first();

        // if ($absen) {
        //     dd('sudah absen');
        // } else {
        Absen_karyawan::create([
            'tanggal'      => $tanggal,
            'jam_masuk'     => $time,
            'absen'      => $request->absen,
            'keterangan'       => $request->ket,
            'cuti'  => $request->cuti,
            'id_karyawan' => auth()->user()->id,
        ]);

        return redirect('absen_karyawan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $absen = Absen_karyawan::find($id);
        $absen->update([
            'keterangan' => $request->ket
        ]);


        return redirect('absen_karyawan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
