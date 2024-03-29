<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\role;
use Illuminate\Support\Facades\DB;

class roleController extends Controller
{
    //
    public function index(){
        $roles = role::all();

        if(count($roles) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $roles
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id_role){
        $role = role::find($id_role);

        if(!is_null($role)){
            return response([
                'message' => 'Retrieve Role Success',
                'data' => $role
            ], 200);
        }

        return response([
            'message' => 'Role Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'id_role' => 'required',
            'nama_role' => 'required'
        ]);

        $count = DB::table('roles')->count()+1;

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $role = role::create([
            'id_role' => $count,
            'nama_role' => $request->nama_role,
        ]);
        return response([
            'message' => 'Add Role Success',
            'data' => $role
        ], 200);
    }

    public function destroy($id_role){
        $role = role::find($id_role);

        if(is_null($role)){
            return response([
                'message' => 'Role not found',
                'data' => null
            ], 404);
        }

        if($role->delete()){
            return response([
                'message' => 'Delete Role Success',
                'data' => $role
            ], 200);
        }

        return response([
            'message' => 'Delete Role Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id_role){
        $role = role::find($id_role);
        if(is_null($role)){
            return response([
                'message' => 'Role not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'id_role' => 'required',
            'nama_role' => 'required'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }

        $role->id_role = $updateData['id_role'];
        $role->nama_role = $updateData['nama_role'];

        if($role->save()){
            return response([
                'message' => 'Update Role Success',
                'data' => $role
            ], 200);
        }

        return response ([
            'message' => 'Update Role Failed',
            'data' => null,
        ],404);
    }
}
