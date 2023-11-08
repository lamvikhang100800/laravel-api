<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Http\Requests\CategoryRequest;


class CategoriesController extends Controller
{
    public function create(CategoryRequest $request){
        try {
            
            return response()->json([
                'data' => 'hello'
            ]);
            // $categoty = Categories::create($request->all()) ;
            // return response()->json([
            //     'success'=> true ,
            //     'message'=> 'Create Categories Success !',
            //     'data'=>  $categoty ,
            //     'status'=>201
            //    ],201);

        } catch (Exception $e) {
            $message = $e->getMessage();
            return response()->json([
                'error' => $message,
                'status' => 400
            ], 400);
           
        }
        
    }
    public function get($category_id = null ){
        if($category_id){
            $data = Categories::find($category_id);
            if( $data){
                return response()->json([
                    'success'=> true ,
                    'data'=> $data,
                    'status'=>200
                   ],200);
            }
            return response()->json([
                'error'=> 'Category Id Not Exist !',
                'status'=>400
               ],400);
            
        }else{
            $data = Categories::all();
            return response()->json([
                'success'=> true ,
                'data'=> $data,
                'status'=>200
               ],200);
        }
    }
    public function update(CategoryRequest $request , $category_id ){
        $category = Categories::find($category_id);
        if($category){
            $category->update($request->all());
            return response()->json([
                'success'=> true ,
                'massage'=> 'Update Category Success !',
                'status'=>200
               ],200);
        }else{
            return response()->json([
                'error'=> 'Category Id Not Exist !',
                'status'=>400
               ],400);
        }
    }
    public function delete($category_id){
        $category = Categories::find($category_id);
        if($category){
            $category->delete();
            return response()->json([
                'success'=> true ,
                'massage'=> 'Delete Category Success !',
                'status'=>200
               ],200);
        }else{
            return response()->json([
                'error'=> 'Category Id Not Exist !',
                'status'=>400
               ],400);
        }
    }

}
