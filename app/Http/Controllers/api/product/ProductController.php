<?php

namespace App\Http\Controllers\api\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }
    //---------------------------------
    public function index()
    {
       // return response(['currentUser' => 'this is my message']);
        $product = Auth::user()->Product()->get();
        return  $product;
    }
    //---------------------------------
    public function create()
    {
        return response(['currentUser' => 'this is my message']);
    }
    //---------------------------------
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'unique:products|required',
            'category_id' => 'required',
           // 'user_id' => 'required',
            // 'user_type' => 'required',
        ];
        $user_id =  Auth::user()->id;
        //$user_id = $request->user_id;

        $input     = $request->only('name', 'category_id');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        return Product::create(['user_id' => $user_id, 'category_id' => $request->category_id,
            'name' =>$request->name]);
    }
    //------------------------------
    public function show($id)
    {
        //return response(['user_id' => $id]);
       // User::find($id)->UserAddress()->get();

        $product = Product::find($id);
        if ($product){
            return $product;
        }else{
            return response(['status' => '404',
                'error' => 'info is not found']);
        }

    }
    //---------------------------------
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    //---------------------------------
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product){
            $data = $request->all();
            $product->update($data);
            return $product;
        }else{
            return response(['status' => '404',
                'error' => 'info is not found']);
        }
    }
    //---------------------------------
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //---------------------------------
}
