<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function indexAll(){
        $data = Product::all();
        $status = count($data);
        return $status ? response()->json(['message' => "Product listed successfully",'data' => $data],200): response()->json(['message' => "no record found"],404);
        
    }
    public function store(Request $request){
        // $request->validate([
        //     'name' => 'required|unique:products|max:40',
        //     'price' => 'required',
        // ]);
            if( $request->hasFile('image')){
                $FileName = time().".".$request->image->getClientOriginalExtension();
                $File = $request->image->move('products',$FileName);
                $file = url()->current().$File;
            }else{
                $file = '';
            }
       $product =  Product::create([
            'name'  => $request->name,
            'price'  => $request->price,
            'image'  => $file,
        ]);
        // $status = count($product);
        return $product ? response()->json(['message' => "Product added",'data' => $product],200): response()->json(['message' => "faild to add"],400);
    }
    public function delete($id){
        Product::where("id",$id)->delete();
        return response()->json(['message' => 'Product deleted']);
    }

    public function edit($id){
        $data = Product::where('id',$id)->first();
        return response()->json(['message' => 'Product listed successfully','data' => $data],200);
    }
    public function update(Request $request){
        $product =  Product::where('id',$request->id)->update([
            'name'  => $request->name,
            'price'  => $request->price,
        ]);
        // $status = count($product);
        return $product ? response()->json(['message' => "Product update",'data' => $this->indexAll()],200): response()->json(['message' => "faild to add"],400);
            
        
        
    }
}
