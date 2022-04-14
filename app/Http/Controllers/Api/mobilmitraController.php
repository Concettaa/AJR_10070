<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\mobilmitra;

class mobilmitraController extends Controller
{
    //
    public function index(){
        $mobilmitras = mobilmitra::all();

        if(count($mobilmitras) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $mobilmitras
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($no_ktp_pemilik){
        $mobilmitra = mobilmitra::find($no_ktp_pemilik);

        if(!is_null($mobilmitra)){
            return response([
                'message' => 'Retrieve Mobil Mitra Success',
                'data' => $mobilmitra
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

        $mobilmitra = mobilmitra::create($storeData);
        return response([
            'message' => 'Add Mobil Mitra Success',
            'data' => $mobilmitra
        ], 200);
    }

    public function destroy($no_ktp_pemilik){
        $mobilmitra = mobilmitra::find($no_ktp_pemilik);

        if(is_null($mobilmitra)){
            return response([
                'message' => 'Mobil Mitra not found',
                'data' => null
            ], 404);
        }

        if($mobilmitra->delete()){
            return response([
                'message' => 'Delete Mobil Mitra Success',
                'data' => $mobilmitra
            ], 200);
        }

        return response([
            'message' => 'Delete Mobil Mitra Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $no_ktp_pemilik){
        $mobilmitra = mobilmitra::find($no_ktp_pemilik);
        if(is_null($mobilmitra)){
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

        $mobilmitra->nama_pemilik = $updateData['nama_pemilik'];
        $mobilmitra->alamat_pemilik = $updateData['alamat_pemilik'];
        $mobilmitra->no_telp_pemilik = $updateData['no_telp_pemilik'];
        $mobilmitra->periode_kontrak_mulai = $updateData['periode_kontrak_mulai'];
        $mobilmitra->periode_kontrak_akhir = $updateData['periode_kontrak_akhir'];
        $mobilmitra->tanggal_terakhir_kali_servis = $updateData['tanggal_terakhir_kali_servis'];

        if($mobilmitra->save()){
            return response([
                'message' => 'Update Mobil Mitra Success',
                'data' => $mobilmitra
            ], 200);
        }

        return response ([
            'message' => 'Update Mobil Mitra Failed',
            'data' => null,
        ],404);
    }
}
