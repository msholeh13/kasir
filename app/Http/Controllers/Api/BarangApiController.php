<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BarangApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Barang::orderBy('nobarcode', 'desc')->get();
        return response()->json([
            'status'    => 'success',
            'message'   => 'data semua barang',
            'data'      => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama'  => 'required|unique:barang,nama',
            'harga' => 'required|numeric',
            'stok'  => 'required|numeric',
        ]);

        if (!$validator->fails()) {
            $companyId = '666666';

            $lastRecord = Barang::orderBy('nobarcode', 'desc')->withTrashed()->value('nobarcode');

            $lastNumber = $lastRecord ? (int) substr($lastRecord, 6) : 0;

            $newNumber = $lastNumber + 1;
            $newCode = $companyId . str_pad($newNumber, 6, '0', STR_PAD_LEFT);

            Barang::create([
                'nobarcode'     => $newCode,
                'nama'          => $request->nama,
                'harga'         => $request->harga,
                'stok'          => $request->stok,
            ]);

            return response()->json([
                'status'    => 'success',
                'message'   => 'sukses menyimpan barang',
            ]);
        }

        return response()->json([
            'status'    => 'failed',
            'message'   => 'gagal menyimpan barang',
            'error'     => $validator->errors(),
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nobarcode)
    {
        $data = Barang::where('nobarcode', $nobarcode)->first();

        if (!$data) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'barang tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status'    => 'success',
            'message'   => 'barang telah ditemukan',
            'data'      => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nobarcode)
    {
        $validator = Validator::make($request->all(), [
            'nama'  => 'required|unique:barang,nama,' . $nobarcode . ',nobarcode',
            'harga' => 'required|numeric',
            'stok'  => 'required|numeric',
        ]);

        $data = Barang::where('nobarcode', $nobarcode)->first();

        if (!$data) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'barang tidak ditemukan',
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
        $data->harga = $request->harga;
        $data->stok = $request->stok;

        $data->save();

        return response()->json([
            'status'    => 'success',
            'message'   => 'berhasil mengupdate data barang',
            'data'      => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nobarcode)
    {
        $data = Barang::where('nobarcode', $nobarcode)->delete();

        if ($data === 0) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'gagal menghapus barang, barang tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status'    => 'success',
            'message'   => 'berhasil menghapus barang',
        ]);
    }
}
