<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function allCategory(){
        $all_category=Category::all();
        $result=array(['message'=>'All Category List','data'=>$all_category]);
        $response_code=200;
        return response()->json( $result,$response_code);
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

                $result=array(['message'=>'Successfully Inserted','data'=>$category]);
                $response_code=200;
                return response()->json( $result,$response_code);

        } catch (Exception $exception) {
            $result=array(['message'=>$exception->getMessage()]);
            $response_code=400;
            return response()->json( $result,$response_code);
        }

    }

    public function findCategory(Request $request){
        $a_category=Category::find($request->id);
        $result=array(['message'=>'Find Your Desired Category','data'=>$a_category]);
        $response_code=200;
        return response()->json( $result,$response_code);
    }
    public function deleteCategory(Request $request){
        $a_category=Category::find($request->id);
        $a_category->delete();
        $result=array(['message'=>'Delete Your Desired Category','data'=>$a_category]);
        $response_code=200;
        return response()->json( $result,$response_code);
    }




    public function updateCategory(Request $request){

        $validator=Validator::make($request->all(),[
            'name'=>'required|max:255',
        ]);

        if($validator->fails()){
            $result=array('message'=>'Validation errors','errors_msg'=>$validator->errors());
            $response_code=400;
            return response()->json( $result,$response_code);
        }
        $a_category=Category::find($request->id);


        if (!$a_category) {
            $result=array(['message'=>'Category Not Found']);
            $response_code=400;
            return response()->json($result,$response_code);
        }
        try {
            Category::where('id', $request->id)
                ->update([
                    'name'=>$request->name,
                    'description'=>$request->description,
                ]);

                $result=array(['message'=>'Successfully Updated']);
                $response_code=200;
                return response()->json( $result,$response_code);

        } catch (Exception $exception) {
            $result=array(['message'=>$exception->getMessage()]);
            $response_code=400;
            return response()->json( $result,$response_code);
        }

    }

}
