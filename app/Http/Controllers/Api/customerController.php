<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\customer;
use Carbon\carbon;
use Illuminate\Support\Facades\DB;

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
            'nama_customer' => 'required|alpha|max:60',
            'alamat_customer' => 'required|max:100',
            'tanggal_lahir_customer' => 'required',
            'jenis_kelamin_customer' => 'required',
            'email_customer' => 'required|email:rfc,dns',
            'no_telp_customer' => 'required|digits_between:10,13|numeric|regex:/(08)[0-9]/',
            'nomor_ktp' => 'required|min:16|numeric'
        ]);

        $count = DB::table('customers')->count()+1;
        $generate = sprintf("%03d", $count);
        $datenow = Carbon::now()->format('ymd');

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $customer = customer::create([
            'id_customer' => 'CUS'.$datenow.'-'.$generate,
            'nama_customer' => $request->nama_customer,
            'alamat_customer' => $request->alamat_customer,
            'tanggal_lahir_customer' => $request->tanggal_lahir_customer,
            'jenis_kelamin_customer' => $request->jenis_kelamin_customer,
            'email_customer' => $request->email_customer,
            'no_telp_customer' => $request->no_telp_customer,
            'nomor_ktp' => $request->nomor_ktp
        ]);
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
            'email_customer' => 'required|email:rfc,dns',
            'no_telp_customer' => 'required|digits_between:10,13|numeric|regex:/(08)[0-9]/',
            'nomor_ktp' => 'required|min:16|numeric'
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
