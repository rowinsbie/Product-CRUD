<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductFile;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response()->json(Product::orderBy('created_at', 'desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //check if product name already exists
        $product_name = strtolower(ucwords($request['prod_name']));
        $isExists = Product::where('product_name',$product_name)->exists();
        if($isExists)
        {
            return Response()->json([
                'Message'=>$product_name . ' is already exists'
            ],409);
        }
        // File uploading
        $file = $request->file('img');
        $ext = $file->getClientOriginalExtension();
        $fileName = $file->hashName();
        $isUploaded = $file->storeAs('public/products/',$fileName);
        if(!$isUploaded)
        {
            return Response()->json([
                'Message'=>"We've encountered an error during the uploading of your file"
            ],500);
        }
      

        // once the file has been uploaded successfully
        // The system wiull save the product information to the products table in the database

        $newProduct = Product::create([
            'product_name'=>$product_name,
            'unit'=>$request['unit'],
            'price'=>$request['price'],
            'expiration_date'=>date('Y/m/d',strtotime($request['exp'])),
            'available_inventory'=>$request['ai'],
            'image'=>$fileName
        ]);


        return Response()->json([
            'Message'=>"New Product has been created",
            'Product'=>$newProduct
        ],200);

         
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return Response()->json([
            'Message'=>"The product information has been loaded",
            'Product'=>$product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $isUpdated = $product::find($request['pid'])
        ->update([
            'product_name'=>$request['u_prod_name'],
            'unit'=>$request['u_unit'],
            'price'=>$request['u_price'],
            'expiration_date'=>date('Y/m/d',strtotime($request['u_exp'])),
            'available_inventory'=>$request['u_ai']
        ]);
        if($isUpdated)
        {
            return Response()->json([
                'Message'=>"Product has been updated"
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = Product::find($id)->delete();
        if(!$isDeleted)
        {
            return Response()->json([
                'Message'=>"We have encountered an error during the deletion of the product"
            ],500);
        }

        return Response()->json([
            'Message'=>"The product has been deleted"
        ],200);
    }
}
