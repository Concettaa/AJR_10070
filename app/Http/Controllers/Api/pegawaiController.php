<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\pegawai;
use Illuminate\Support\Facades\DB;

class pegawaiController extends Controller
{
    //
    public function index(){
        $pegawais = pegawai::all();

        if(count($pegawais) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $pegawais
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id_pegawai){
        $pegawai = pegawai::find($id_pegawai);

        if(!is_null($pegawai)){
            return response([
                'message' => 'Retrieve Pegawai Success',
                'data' => $pegawai
            ], 200);
        }

        return response([
            'message' => 'Pegawai Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_pegawai' => 'required|max:60|alpha',
            'alamat_pegawai' => 'required',
            'tanggal_lahir_pegawai' => 'required',
            'email_pegawai' => 'required|email:rfc,dns',
            'no_telp_pegawai' => 'required|digits_between:10,13|numeric|regex:/(08)[0-9]/',
            'jenis_kelamin_pegawai' => 'required',
            'id_role' => 'required'
        ]);

        $count = DB::table('pegawais')->count()+1;

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $pegawai = pegawai::create([
            'id_pegawai' => $count,
            'nama_pegawai' => $request->nama_pegawai,
            'alamat_pegawai' => $request->alamat_pegawai,
            'tanggal_lahir_pegawai' => $request->tanggal_lahir_pegawai,
            'email_pegawai' => $request->email_pegawai,
            'no_telp_pegawai' => $request->no_telp_pegawai,
            'jenis_kelamin_pegawai' => $request->jenis_kelamin_pegawai,
            'id_role' => $request->id_role
        ]);
        return response([
            'message' => 'Add Pegawai Success',
            'data' => $pegawai
        ], 200);
    }

    public function destroy($id_pegawai){
        $pegawai = pegawai::find($id_pegawai);

        if(is_null($pegawai)){
            return response([
                'message' => 'pegawai not found',
                'data' => null
            ], 404);
        }

        if($pegawai->delete()){
            return response([
                'message' => 'Delete Pegawai Success',
                'data' => $pegawai
            ], 200);
        }

        return response([
            'message' => 'Delete Pegawai Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id_pegawai){
        $pegawai = pegawai::find($id_pegawai);
        if(is_null($pegawai)){
            return response([
                'message' => 'Pegawai not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_pegawai' => 'required|max:60|alpha',
            'alamat_pegawai' => 'required',
            'tanggal_lahir_pegawai' => 'required',
            'email_pegawai' => 'required|email:rfc,dns',
            'no_telp_pegawai' => 'required|digits_between:10,13|numeric|regex:/(08)[0-9]/',
            'jenis_kelamin_pegawai' => 'required',
            'id_role' => 'required'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }

        $pegawai->nama_pegawai = $updateData['nama_pegawai'];
        $pegawai->alamat_pegawai = $updateData['alamat_pegawai'];
        $pegawai->tanggal_lahir_pegawai = $updateData['tanggal_lahir_pegawai'];
        $pegawai->email_pegawai = $updateData['email_pegawai'];
        $pegawai->no_telp_pegawai = $updateData['no_telp_pegawai'];
        $pegawai->jenis_kelamin_pegawai = $updateData['jenis_kelamin_pegawai'];
        $pegawai->id_role = $updateData['id_role'];

        if($pegawai->save()){
            return response([
                'message' => 'Update Pegawai Success',
                'data' => $pegawai
            ], 200);
        }

        return response ([
            'message' => 'Update Pegawai Failed',
            'data' => null,
        ],404);
    }
}
