<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\transaksi;

class transaksiController extends Controller
{
    //
    public function index(){
        $transaksis = transaksi::all();

        if(count($transaksis) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $transaksis
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($no_ktp_pemilik){
        $transaksi = transaksi::find($no_ktp_pemilik);

        if(!is_null($transaksi)){
            return response([
                'message' => 'Retrieve Mobil Mitra Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Mobil Mitra Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_pemilik' => 'required|alpha',
            'no_ktp_pemilik' => 'required|max:16',
            'alamat_pemilik' => 'required',
            'no_telp_pemilik' => 'required|digits_between:10,13|numeric|regex:/(08)[0-9]/',
            'periode_kontrak_mulai' => 'required',
            'periode_kontrak_akhir' => 'required',
            'tanggal_terakhir_kali_servis' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $transaksi = transaksi::create($storeData);
        return response([
            'message' => 'Add Mobil Mitra Success',
            'data' => $transaksi
        ], 200);
    }

    public function destroy($no_ktp_pemilik){
        $transaksi = transaksi::find($no_ktp_pemilik);

        if(is_null($transaksi)){
            return response([
                'message' => 'Mobil Mitra not found',
                'data' => null
            ], 404);
        }

        if($transaksi->delete()){
            return response([
                'message' => 'Delete Mobil Mitra Success',
                'data' => $transaksi
            ], 200);
        }

        return response([
            'message' => 'Delete Mobil Mitra Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $no_ktp_pemilik){
        $transaksi = transaksi::find($no_ktp_pemilik);
        if(is_null($transaksi)){
            return response([
                'message' => 'Mobil Mitra not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_pemilik' => 'required|alpha',
            'alamat_pemilik' => 'required',
            'no_telp_pemilik' => 'required|digits_between:10,13|numeric|regex:/(08)[0-9]/',
            'periode_kontrak_mulai' => 'required',
            'periode_kontrak_akhir' => 'required',
            'tanggal_terakhir_kali_servis' => 'required'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }

        $transaksi->nama_pemilik = $updateData['nama_pemilik'];
        $transaksi->alamat_pemilik = $updateData['alamat_pemilik'];
        $transaksi->no_telp_pemilik = $updateData['no_telp_pemilik'];
        $transaksi->periode_kontrak_mulai = $updateData['periode_kontrak_mulai'];
        $transaksi->periode_kontrak_akhir = $updateDatap['periode_kontrak_akhir'];
        $transaksi->tanggal_terakhir_kali_servis = $updateDatap['tanggal_terakhir_kali_servis'];

        if($transaksi->save()){
            return response([
                'message' => 'Update Mobil Mitra Success',
                'data' => $transaksi
            ], 200);
        }

        return response ([
            'message' => 'Update Mobil Mitra Failed',
            'data' => null,
        ],404);
    }
}
