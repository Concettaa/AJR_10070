<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\promo;

class promoController extends Controller
{
    //
    public function index(){
        $promos = promo::all();

        if(count($promos) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $promos
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($kode_promo){
        $promo = promo::find($kode_promo);

        if(!is_null($promo)){
            return response([
                'message' => 'Retrieve Promo Success',
                'data' => $promo
            ], 200);
        }

        return response([
            'message' => 'Promo Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'kode_promo' => 'required',
            'jenis_promo' => 'required',
            'keterangan' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $promo = promo::create($storeData);
        return response([
            'message' => 'Add Promo Success',
            'data' => $promo
        ], 200);
    }

    public function destroy($kode_promo){
        $promo = promo::find($kode_promo);

        if(is_null($promo)){
            return response([
                'message' => 'Promo not found',
                'data' => null
            ], 404);
        }

        if($promo->delete()){
            return response([
                'message' => 'Delete Promo Success',
                'data' => $promo
            ], 200);
        }

        return response([
            'message' => 'Delete Promo Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $kode_promo){
        $promo = promo::find($kode_promo);
        if(is_null($promo)){
            return response([
                'message' => 'Promo not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'jenis_promo' => 'required',
            'keterangan' => 'required'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }

        $promo->nama_murid = $updateData['nama_murid'];
        $promo->npm = $updateData['npm'];
        $promo->tanggal_lahir = $updateData['tanggal_lahir'];

        if($student->save()){
            return response([
                'message' => 'Update Promo Success',
                'data' => $promo
            ], 200);
        }

        return response ([
            'message' => 'Update Promo Failed',
            'data' => null,
        ],404);
    }
}
