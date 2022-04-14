<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\jadwalkerja;
use Illuminate\Support\Facades\DB;

class jadwalkerjaController extends Controller
{
    //
    public function index(){
        $jadwalkerjas = jadwalkerja::all();

        if(count($jadwalkerjas) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $jadwalkerjas
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id_jadwal){
        $jadwalkerja = jadwalkerja::find($id_jadwal);

        if(!is_null($jadwalkerja)){
            return response([
                'message' => 'Retrieve Jadwal Kerja Success',
                'data' => $jadwalkerja
            ], 200);
        }

        return response([
            'message' => 'Jadwal Kerja Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_pegawai' => 'required|alpha|max:60',
            'hari' => 'required|alpha',
            'jam_kerja' => 'required|numeric'
        ]);

        $count = DB::table('jadwalkerjas')->count()+1;

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $jadwalkerja = jadwalkerja::create([
            'id_jadwal' => $count,
            'nama_pegawai' => $request->nama_pegawai,
            'hari' => $request->hari,
            'jam_kerja' => $request->jam_kerja,
        ]);
        return response([
            'message' => 'Add Jadwal Kerja Success',
            'data' => $jadwalkerja
        ], 200);
    }

    public function destroy($id_jadwal){
        $jadwalkerja = jadwalkerja::find($id_jadwal);

        if(is_null($jadwalkerja)){
            return response([
                'message' => 'Jadwal Kerja not found',
                'data' => null
            ], 404);
        }

        if($jadwalkerja->delete()){
            return response([
                'message' => 'Delete Jadwal Kerja Success',
                'data' => $jadwalkerja
            ], 200);
        }

        return response([
            'message' => 'Delete Jadwal Kerja Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id_jadwal){
        $jadwalkerja = jadwalkerja::find($id_jadwal);
        if(is_null($jadwalkerja)){
            return response([
                'message' => 'Jadwal Kerja not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_pegawai' => 'required|alpha|max:60',
            'hari' => 'required|alpha',
            'jam_kerja' => 'required|numeric'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }

        $jadwalkerja->nama_pegawai = $updateData['nama_pegawai'];
        $jadwalkerja->hari = $updateData['hari'];
        $jadwalkerja->jam_kerja = $updateData['jam_kerja'];

        if($jadwalkerja->save()){
            return response([
                'message' => 'Update Jadwal Kerja Success',
                'data' => $jadwalkerja
            ], 200);
        }

        return response ([
            'message' => 'Update Jadwal Kerja Failed',
            'data' => null,
        ],404);
    }
}
