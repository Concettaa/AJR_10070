<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\driver;

class driverController extends Controller
{
    //
    public function index(){
        $drivers = driver::all();

        if(count($drivers) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $drivers
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id_driver){
        $driver = driver::find($id_driver);

        if(!is_null($driver)){
            return response([
                'message' => 'Retrieve Driver Success',
                'data' => $driver
            ], 200);
        }

        return response([
            'message' => 'Driver Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'id_driver' => 'required',
            'email_driver' => 'required',
            'nama_driver' => 'required|max:60|alpha',
            'alamat_driver' => 'required|max:100',
            'tanggal_lahir_driver' => 'required',
            'jenis_kelamin_driver' => 'required',
            'no_telp_diver' => 'required|digits_between:10,13|numeric|regex:/(08)[0-9]/',
            'bahasa' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $driver = driver::create($storeData);
        return response([
            'message' => 'Add Driver Success',
            'data' => $driver
        ], 200);
    }

    public function destroy($id_driver){
        $driver = driver::find($id_driver);

        if(is_null($driver)){
            return response([
                'message' => 'Driver not found',
                'data' => null
            ], 404);
        }

        if($driver->delete()){
            return response([
                'message' => 'Delete Driver Success',
                'data' => $driver
            ], 200);
        }

        return response([
            'message' => 'Delete Driver Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id_driver){
        $driver = driver::find($id_driver);
        if(is_null($driver)){
            return response([
                'message' => 'Driver not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'email_driver' => 'required',
            'nama_driver' => 'required|max:60|alpha',
            'alamat_driver' => 'required|max:100',
            'tanggal_lahir_driver' => 'required',
            'jenis_kelamin_driver' => 'required',
            'no_telp_diver' => 'required|digits_between:10,13|numeric|regex:/(08)[0-9]/',
            'bahasa' => 'required'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }

        $driver->email_driver = $updateData['email_driver'];
        $driver->nama_drover = $updateData['nama_drover'];
        $driver->alamat_driver = $updateData['alamat_driver'];
        $driver->tanggal_lahir_driver = $updateData['tanggal_lahir_driver'];
        $driver->jenis_kelamin_driver =$updateData['jenis_kelamin_driver'];
        $driver->no_telp_driver = $updateData['no_telp'];
        $driver->bahasa = $updateData['bahasa'];


        if($driver->save()){
            return response([
                'message' => 'Update Driver Success',
                'data' => $driver
            ], 200);
        }

        return response ([
            'message' => 'Update Driver Failed',
            'data' => null,
        ],404);
    }
}
