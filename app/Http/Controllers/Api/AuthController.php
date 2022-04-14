<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\pegawai;
use App\Models\customer;
use App\Models\driver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $registrationData = $request->all();
        $validate = Validator::make($registrationData, [
            'nama_customer' => 'required|alpha|max:60',
            'alamat_customer' => 'required|max:100',
            'tanggal_lahir_customer' => 'required',
            'jenis_kelamin_customer' => 'required',
            'email_customer' => 'required',
            'no_telp_customer' => 'required|digits_between:10,13|numeric|regex:/(08)[0-9]/',
            'nomor_ktp' => 'required'
        ]);

        $count = DB::table('customers')->count()+1;
        $generate = sprintf("%03d", $count);
        $datenow = Carbon::now()->format('ymd');

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        // $registrationData['password'] = bcrypt($request->password);
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
            'message' => 'Register Success',
            'data' => $customer
        ], 200);
    }

    public function login(Request $request){
        $loginData = $request->all();
        $emailLogin = $request->email;
        $pwLogin = $request->password;

        $validate = Validator::make($loginData, [
            'email' => 'required|email:rfc,dns',
            'password'=> 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $pegawaiquery = pegawai::where('email_pegawai', '=', $emailLogin)->first();
        $customerquery = customer::where('email_customer', '=', $emailLogin)->first();
        $driverquery = driver::where('email_driver', '=', $emailLogin)->first();

        if($pegawaiquery != NULL){

            $pegawaipw = $pegawaiquery['tanggal_lahir_pegawai'];

            if($pwLogin == $pegawaipw){
                return response([
                    'message' => 'Authenticated',
                    'user' => $pegawaiquery,
                ]);
            }else{
                return response(['message' => 'Invalid Password'], 401);
            }          
        }else if($customerquery != NULL){

            $customerpw = $customerquery['tanggal_lahir_customer'];
            
            if($pwLogin == $customerpw){
                return response([
                    'message' => 'Authenticated',
                    'user' => $customerquery,
                ]);
            }else{
                return response(['message' => 'Invalid Password'], 401);
            }  
            
        }else if($driverquery != NULL AND $driverpw != NULL){

            $driveripw = $driverquery['tanggal_lahir_driver'];
            
            if($pwLogin == $driveripw){
                return response([
                    'message' => 'Authenticated',
                    'user' => $driverquery,
                ]);
            }else{
                return response(['message' => 'Invalid Password'], 401);
            }  

        }else{
            return response(['message' => 'Invalid Credentials'], 401);
        }

        // $user = Auth::user();
        // $token = $user->createToken('Authentication Token')->accessToken;

        // return response([
        //     'message' => 'Authenticated',
        //     'user' => $user,
        //     'token_type' => 'Bearer',
        //     'access_token' => $token
        // ]);
    }
}
