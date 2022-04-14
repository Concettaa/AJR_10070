<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\detailjadwal;

class detailjadwalController extends Controller
{
    //
    public function index(){
        $detailjadwals = detailjadwal::all();

        if(count($detailjadwals) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $detailjadwals
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id_detail){
        $detailjadwal = detailjadwal::find($id_detail);

        if(!is_null($detailjadwal)){
            return response([
                'message' => 'Retrieve Detail Jadwal Success',
                'data' => $detailjadwal
            ], 200);
        }

        return response([
            'message' => 'Detail Jadwal Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'id_pegawai' => 'required',
            'id_jadwal' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $detailjadwal = detailjadwal::create([
            'id_jadwal' => $request->id_jadwal,
            'id_pegawai' => $request->id_pegawai
        ]);
        return response([
            'message' => 'Add Detail Jadwal Success',
            'data' => $detailjadwal
        ], 200);
    }

    public function destroy($id_detail){
        $detailjadwal = detailjadwal::find($id_detail);

        if(is_null($detailjadwal)){
            return response([
                'message' => 'Detail Jadwal not found',
                'data' => null
            ], 404);
        }

        if($detailjadwal->delete()){
            return response([
                'message' => 'Delete Detail Jadwal Success',
                'data' => $detailjadwal
            ], 200);
        }

        return response([
            'message' => 'Delete Detail Jadwal Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id_detail){
        $detailjadwal = detailjadwal::find($id_detail);
        if(is_null($detailjadwal)){
            return response([
                'message' => 'Detail Jadwal not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'id_pegawai' => 'required|numeric',
            'id_jadwal' => 'required|numeric'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }

        $detailjadwal->id_pegawai = $updateData['id_pegawai'];
        $detailjadwal->id_jadwal = $updateData['id_jadwal'];

        if($detailjadwal->save()){
            return response([
                'message' => 'Update Detail Jadwal Success',
                'data' => $detailjadwal
            ], 200);
        }

        return response ([
            'message' => 'Update Detail Jadwal Failed',
            'data' => null,
        ],404);
    }
}
