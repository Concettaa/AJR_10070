<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\mobil;

class mobilController extends Controller
{
    //
    public function index(){
        $mobils = mobil::all();

        if(count($mobils) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $mobils
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($plat_mobil){
        $mobil = mobil::find($plat_mobil);

        if(!is_null($mobil)){
            return response([
                'message' => 'Retrieve Mobil Success',
                'data' => $mobil
            ], 200);
        }

        return response([
            'message' => 'Mobil Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'plat_mobil' => 'required',
            'nama_mobil' => 'required',
            'tipe_mobil' => 'required',
            'jenis_transmisi' => 'required',
            'jenis_bahan_bakar' => 'required',
            'volume_bahan_bakar' => 'required|numeric',
            'warna_mobil' => 'required',
            'kapasitas_penumpang' => 'required|numeric',
            'fasilitas' => 'required',
            'nomor_stnk' => 'required',
            'no_ktp_pemilik' => 'max:16',
            'id_brosur' => 'numeric'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $mobil = mobil::create($storeData);
        return response([
            'message' => 'Add Mobil Success',
            'data' => $mobil
        ], 200);
    }

    public function destroy($plat_mobil){
        $mobil = mobil::find($plat_mobil);

        if(is_null($mobil)){
            return response([
                'message' => 'Mobil not found',
                'data' => null
            ], 404);
        }

        if($mobil->delete()){
            return response([
                'message' => 'Delete Mobil Success',
                'data' => $mobil
            ], 200);
        }

        return response([
            'message' => 'Delete Mobil Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $plat_mobil){
        $mobil = mobil::find($plat_mobil);
        if(is_null($mobil)){
            return response([
                'message' => 'Mobil not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_mobil' => 'required',
            'tipe_mobil' => 'required',
            'jenis_transmisi' => 'required',
            'jenis_bahan_bakar' => 'required',
            'volume_bahan_bakar' => 'required|numeric',
            'warna_mobil' => 'required',
            'kapasitas_penumpang' => 'required|numeric',
            'fasilitas' => 'required',
            'nomor_stnk' => 'required',
            'no_ktp_pemilik' => 'max:16',
            'id_brosur' => 'numeric'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }

        $mobil->nama_mobil = $updateData['nama_mobil'];
        $mobil->tipe_mobil = $updateData['tipe_mobil'];
        $mobil->jenis_transmisi = $updateData['jenis_transmisi'];
        $mobil->jenis_bahan_bakar = $updateData['jenis_bahan_bakar'];
        $mobil->volume_bahan_bakar = $updateData['volume_bahan_bakar'];
        $mobil->warna_mobil = $updateData['warna_mobil'];
        $mobil->kapasitas_penumpang = $updateData['kapasitas_penumpang'];
        $mobil->fasilitas = $updateData['fasilitas'];
        $mobil->nomor_stnk = $updateData['nomor_stnk'];
        $mobil->no_ktp_pemilik = $updateData['no_ktp_pemilik'];
        $mobil->id_brosur = $updateData['id_brosur'];


        if($mobil->save()){
            return response([
                'message' => 'Update Mobil Success',
                'data' => $mobil
            ], 200);
        }

        return response ([
            'message' => 'Update Mobil Failed',
            'data' => null,
        ],404);
    }
}
