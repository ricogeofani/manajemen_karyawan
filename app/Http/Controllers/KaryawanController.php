<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Karyawan::all();

        $datatables = datatables()->of($datas)->addIndexColumn();
        return $datatables->make(true);
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
            'foto' => ['required'],
            'nama' => ['required'],
            'email' => ['required'],
            'telp' => ['required'],
            'alamat' => ['required'],
            'gender'  => ['required'],
            'jabatan' => ['required', 'in:manager,admin,staff,hrd'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {

            $foto_name = $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(\base_path() . "/public/images", $foto_name);

            Karyawan::create([
                'foto'      => $foto_name,
                'nama'      => $request->nama,
                'email'     => $request->email,
                'telp'      => $request->telp,
                'alamat'    => $request->alamat,
                'gender'    => $request->gender,
                'jabatan'   => $request->jabatan,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'failed' . $e->errorInfo,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $karyawan = Karyawan::find($id);

        try {
            $response = [
                'message' => 'data karyawan oderBy id',
                'data'    => $karyawan
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'failed' . $e->errorInfo,
            ]);
        }
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
        $karyawan = Karyawan::find($id);

        $validator = validator::make($request->all(), [
            'foto' => ['required'],
            'nama' => ['required'],
            'email' => ['required'],
            'telp' => ['required'],
            'alamat' => ['required'],
            'gender'  => ['required'],
            'jabatan' => ['required', 'in:manager,admin,staff,hrd'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $foto_name = $request->file('foto')->getClientOriginalName();
            $karyawan->delete_foto();

            $karyawan->update([
                'foto'      => $foto_name,
                'nama'      => $request->nama,
                'email'     => $request->email,
                'telp'      => $request->telp,
                'alamat'    => $request->alamat,
                'gender'    => $request->gender,
                'jabatan'   => $request->jabatan,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'failed' . $e->errorInfo,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);

        try {
            $karyawan->delete_foto();
            $karyawan->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'failed' . $e->errorInfo,
            ]);
        }
    }
}
