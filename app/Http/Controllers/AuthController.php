<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator=Validator::make($request->all(),[
            'password'=>'required',
            'email'=>'required',
        ]);
        if($validator->fails()){
            $result=array('message'=>'Validation errors','errors_msg'=>$validator->errors());
            $response_code=400;
            return response()->json( $result,$response_code);
        }
        try {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $user=Auth::user();

                $token = $user->createToken('token-name');
                $result=array(['message'=>'Successfully Login','data'=>$user,'access_token' => $token->plainTextToken,
        'token_type' => 'Bearer',]);
                $response_code=200;
                return response()->json( $result,$response_code);
            }
        } catch (Exception $exception) {
            $result=array(['message'=>$exception->getMessage()]);
            $response_code=400;
            return response()->json( $result,$response_code);
        }
        $result=array(['message'=>'Invalied Username and Password']);
        $response_code=400;
        return response()->json( $result,$response_code);

    }
    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:8',
        ]);
        if($validator->fails()){
            $result=array('message'=>'Validation errors','errors_msg'=>$validator->errors());
            $response_code=400;
            return response()->json( $result,$response_code);
        }
        try {
            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            $token = $user->createToken('token-name')->plainTextToken;
            $result=array(['message'=>'Successfully Login','data'=>$user,'token'=> $token]);
            $response_code='200';
            return response()->json($result,$response_code);
        } catch (Exception $exception) {
            $result=array(['message'=>$exception->getMessage()]);
            $response_code=400;
            return response()->json( $result,$response_code);
        }

    }
}
