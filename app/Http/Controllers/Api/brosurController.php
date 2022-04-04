<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\brosur;

class brosurController extends Controller
{
    //
    public function index(){
        $brosurs = brosur::all();

        if(count($brosurs) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $brosurs
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id_brosur){
        $brosur = brosur::find($id_brosur);

        if(!is_null($brosur)){
            return response([
                'message' => 'Retrieve Brosur Success',
                'data' => $brosur
            ], 200);
        }

        return response([
            'message' => 'Brosur Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'id_brosur' =>  'required|max:60',
            'nama_mobil' => 'required|max:60',
            'tipe_mobil' => 'required|max:60',
            'jenis_transmisi' => 'required|max:60',
            'jenis_bahan_bakar' => 'required|max:60',
            'warna_mobil' => 'required|max:60',
            'volume_bagasi' => 'required|numeric',
            'fasilitas' => 'required|max:100',
            'harga_sewa' => 'required|numeric'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $brosur = brosur::create($storeData);
        return response([
            'message' => 'Add Brosur Success',
            'data' => $brosur
        ], 200);
    }

    public function destroy($id_brosur){
        $brosur = brosur::find($id_brosur);

        if(is_null($brosur)){
            return response([
                'message' => 'Brosur not found',
                'data' => null
            ], 404);
        }

        if($brosur->delete()){
            return response([
                'message' => 'Delete Brosur Success',
                'data' => $brosur
            ], 200);
        }

        return response([
            'message' => 'Delete Brosur Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id_brosur){
        $brosur = brosur::find($id_brosur);
        if(is_null($brosur)){
            return response([
                'message' => 'Brosur not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_mobil' => 'required|max:60',
            'tipe_mobil' => 'required|max:60',
            'jenis_transmisi' => 'required|max:60',
            'jenis_bahan_bakar' => 'required|max:60',
            'warna_mobil' => 'required|max:60',
            'volume_bagasi' => 'required|numeric',
            'fasilitas' => 'required|max:100',
            'harga_sewa' => 'required|numeric'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }

        $brosur->nama_mobil = $updateData['nama_mobil'];
        $brosur->tipe_mobil = $updateData['tipe_mobil'];
        $brosur->jenis_transmisi = $updateData['jenis_transmisi'];
        $brosur->jenis_bahan_bakar = $updateData['jenis_bahan_bakar'];
        $brosur->warna_mobil = $updateData['warna_mobil'];
        $brosur->volume_bagasi = $updateData['volume_bagasi'];
        $brosur->fasilitas = $updateData['fasilitas'];
        $brosur->harga_sewa = $updateData['harga_sewa'];

        if($brosur->save()){
            return response([
                'message' => 'Update Brosur Success',
                'data' => $brosur
            ], 200);
        }

        return response ([
            'message' => 'Update Brosur Failed',
            'data' => null,
        ],404);
    }
}
