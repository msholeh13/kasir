<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Supplier::orderBy('idsup', 'desc')->get();
        return response()->json([
            'status'    => 'success',
            'message'   => 'data semua supplier',
            'data'      => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'alamat'    => 'required',
            'nohp'      => 'required|min:11|unique:supplier',
        ]);

        if (!$validator->fails()) {
            Supplier::create([
                'nama'      => $request->nama,
                'alamat'    => $request->alamat,
                'nohp'      => $request->nohp,
            ]);

            return response()->json([
                'status'    => 'success',
                'message'   => 'sukses menyimpan supplier',
            ]);
        } else {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'gagal menyimpan supplier',
                'error'     => $validator->errors(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idsup)
    {
        $data = Supplier::where('idsup', $idsup)->first();

        if (!$data) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'supplier tidak ditemukan',
            ], 404);
        } else {
            return response()->json([
                'status'    => 'success',
                'message'   => 'supplier telah ditemukan',
                'data'      => $data
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idsup)
    {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'alamat'    => 'required',
            'nohp'      => 'required|min:11|unique:supplier,nohp,' . $idsup . ',idsup',
        ]);

        $data = Supplier::where('idsup', $idsup)->first();

        if (!$data) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'supplier tidak ditemukan',
            ], 404);
        }

        if ($validator->fails()) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'salah menginputkan data barang',
                'error'     => $validator->errors(),
            ], 422);
        }

        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->nohp = $request->nohp;
        $data->save();

        return response()->json([
            'status'    => 'success',
            'message'   => 'berhasil mengupdate data supplier',
            'data'      => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idsup)
    {
        $data = Supplier::where('idsup', $idsup)->delete();

        if ($data === 0) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'gagal menghapus supplier, supplier tidak ditemukan',
            ], 404);
        } else {
            return response()->json([
                'status'    => 'success',
                'message'   => 'berhasil menghapus supplier',
            ]);
        }
    }
}
