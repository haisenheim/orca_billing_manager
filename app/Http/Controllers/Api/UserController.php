<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client as TwilioClient;


class UserController extends Controller
{
	/*
	 *  Login action
	 */

//password db : ilove@_You2
	//Please add this method
	public function login() {
		// get email and password from request
		$credentials = request(['phone', 'password']);
        $fournisseur_id = request('fournisseur_id');
		// try to auth and get the token using api authentication
		if (!$token = auth('api')->attempt($credentials)) {
			// if the credentials are wrong we send an unauthorized error in json format
			return response()->json(['error' => 'Unauthorized'], 401);
		}



		$user = auth('api')->user();

        if ($user->deleted_at) {
			// if the credentials are wrong we send an unauthorized error in json format
			return response()->json(['error' => 'Compte inexistant'], 403);
		}

        return response()->json([
			'token' => $token,
			'type' => 'bearer', // you can ommit this
			'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration
			'user'=>auth('api')->user(),


		]);
	}


    public function deleteAccount(){
        $client = Client::where('token',request()->token)->first();
        $client->deleted_at = new \DateTime();
        $client->deleted_month = date('m');
        $client->deleted_year = date('Y');
        $client->phone = '_'.$client->phone;
        $client->save();
        return response()->json('ok');
    }




    public function resetPassword($phone){
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $code = rand(1000,9999);
        $client = new TwilioClient($account_sid, $auth_token);
        $client->messages->create('+242'.$phone, ['from' => $twilio_number, 'body' => 'Votre  code est : '.$code]);
        return response()->json(['code'=>$code],200);
    }




	/**
	 * Register api.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request)
	{
 		 $validator = Validator::make($request->all(), [
			'name' => 'required',
			'phone' => 'required|unique:clients',
		]);
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'message' => $validator->errors(),
			], 401);
		}
        $exist = Client::where('phone',$request->phone)->first();
        if($exist){
            return response()->json([
                'success'=>false,
                'message'=>'Ce compte existe deja',
            ],410);
        }

		$user = Client::create([
            'phone'=>request()->phone,
            'name'=>request()->name,
            'ville_id'=>1,
            'token'=>sha1(date('Yhimds').rand(0,9999))
        ]);
		
        return response()->json([
			'success' => true,
			'user' => $user,
		]);
	}

    public function updateUser(Request $request)
	{
 		 $validator = Validator::make($request->all(), [
			'last_name' => 'required',
			'phone' => 'required|unique:clients',
		]);
		if ($validator->fails()) {
			return response()->json([
				'success' => false,
				'message' => $validator->errors(),
			], 401);
		}
        $password = $request->password;
		$input = $request->except('password');
        if(strlen($password)){
            $input['password'] = bcrypt(request('password'));
        }
		Client::updateOrCreate(['id'=>$request->id],$input);
        return response()->json(['success' => true]);
	}
}
