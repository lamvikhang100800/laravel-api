<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;


class ProductController extends Controller
{
    public function create(ProductRequest $request){
        try {
            $product = Product::create($request->all());
            return response()->json([
                'success'=> true ,
                'massage'=> 'Create Product Success !',
                'data'=> $product,
                'status'=>201
               ],201);
        } catch (Exception $e ) {
            $message = $e->getMessage();
            return response()->json([
                'error' => $message,
                'status' => 400
            ], 400);
        }

    }
    public function get($product_id = null){
        if($product_id){
            $productExist = Product::find($product_id);
            if($productExist){
                $data = Product::join('categories','products.category_id','=','categories.category_id')->where('products.product_id',$product_id)->get();
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
            $data = Product::join('categories','products.category_id','=','categories.category_id')->get();
            return response()->json([
                'success'=> true ,
                'data'=> $data,
                'status'=>200
               ],200);
        }
    }
    
    public function update(ProductRequest $request , $product_id){
        $product = Product::find($product_id);
        if($product){
            $product->update($request->all());
            return response()->json([
                'success'=> true ,
                'massage'=> 'Update Category Success !',
                'status'=>200
               ],200);
        }else{
            return response()->json([
                'error'=> 'Product Id Not Exist !',
                'status'=>400
               ],400);
        }
    }
    public function delete($product_id){
        $product = Product::find($product_id);
        if($product){
            $product->delete();
            return response()->json([
                'success'=> true ,
                'massage'=> 'Delete Product Success !',
                'status'=>200
               ],200);
        }else{
            return response()->json([
                'error'=> 'Product Id Not Exist !',
                'status'=>400
               ],400);
        }
    }
}
