<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\customer;

class customerController extends Controller
{
    //
    public function index(){
        $customers = customer::all();

        if(count($customers) >0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $customers
            ],200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id_customer){
        $customer = customer::find($id_customer);

        if(!is_null($customer)){
            return response([
                'message' => 'Retrieve Customer Success',
                'data' => $customer
            ], 200);
        }

        return response([
            'message' => 'Customer Not Found',
            'data' => null
        ], 404);
    }

    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'id_customer' => 'required',
            'nama_customer' => 'required|alpha|max:60',
            'alamat_customer' => 'required|max:100',
            'tanggal_lahir_customer' => 'required',
            'jenis_kelamin_customer' => 'required',
            'email_customer' => 'required',
            'no_telp_customer' => 'required|digits_between:10,13|numeric|regex:/(08)[0-9]/',
            'nomor_ktp' => 'required'

        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $customer = customer::create($storeData);
        return response([
            'message' => 'Add Customer Success',
            'data' => $customer
        ], 200);
    }

    public function destroy($id_customer){
        $customer = customer::find($id_customer);

        if(is_null($customer)){
            return response([
                'message' => 'Customer not found',
                'data' => null
            ], 404);
        }

        if($customer->delete()){
            return response([
                'message' => 'Delete Customer Success',
                'data' => $customer
            ], 200);
        }

        return response([
            'message' => 'Delete Customer Failed',
            'data' => null,
        ], 400);
    }

    public function update(Request $request, $id_customer){
        $customer = customer::find($id_customer);
        if(is_null($customer)){
            return response([
                'message' => 'Customer not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'nama_customer' => 'required|alpha|max:60',
            'alamat_customer' => 'required|max:100',
            'tanggal_lahir_customer' => 'required',
            'jenis_kelamin_customer' => 'required',
            'email_customer' => 'required',
            'no_telp_customer' => 'required|digits_between:10,13|numeric|regex:/(08)[0-9]/',
            'nomor_ktp' => 'required'
        ]);

        if($validate->fails()){
            return response (['message' => $validate->errors()], 400);
        }

        $customer->nama_customer = $updateData['nama_customer'];
        $customer->alamat_customer = $updateData['alamat_customer'];
        $customer->tanggal_lahir_customer = $updateData['tanggal_lahir_customer'];
        $customer->jenis_kelamin_customer = $updateData['jenis_kelamin_customer'];
        $customer->email_customer = $updateData['email_customer'];
        $customer->no_telp_customer = $updateData['no_telp_customer'];
        $customer->nomor_ktp = $updateData['nomor_ktp'];

        if($customer->save()){
            return response([
                'message' => 'Update Customer Success',
                'data' => $customer
            ], 200);
        }

        return response ([
            'message' => 'Update Customer Failed',
            'data' => null,
        ],404);
    }
}
