<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $all_category=Category::all();
    }
    public function storeCategory(Request $request){

        $validator=Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);
        if($validator->fails()){
            $result=array('message'=>'Validation errors','errors_msg'=>$validator->errors());
            $response_code=400;
            return response()->json( $result,$response_code);
        }
        try {
            $category=Category::create([
                'name'=>$request->name,
                'description'=>$request->description,
            ]);
               // $user=Auth::user();
                $token=11111;


                $result=array(['message'=>'Successfully Inserted','data'=>$category,'token'=>$token]);
                $response_code=200;
                return response()->json( $result,$response_code);

        } catch (Exception $exception) {
            $result=array(['message'=>$exception->getMessage()]);
            $response_code=400;
            return response()->json( $result,$response_code);
        }

    }
    public function show(){

    }
    public function update(Request $request){

    }
    public function destroy(){

    }
}
