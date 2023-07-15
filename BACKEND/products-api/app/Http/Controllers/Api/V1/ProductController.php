<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required |max: 255',
            'category' => 'required |max: 255',
            'quantity'=> 'required',
            'unitary_price' => 'required',
            'user_id' => 'required',
            'company_id' => 'required',
        ]);
       
        if($validator->fails()){
            return $this->error("Data invalid",422, $validator->errors());
        }

        $created = Product::create($validator->validated());
        if(!$created)
        {
            return $this->error('Something wrong',400);
        }
        return $this->response("Product Created",200,new ProductResource($created));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
       
        $validator = Validator::make($request->all(), [
            'name' => 'required |max: 255',
            'category' => 'required |max: 255',
            'quantity'=> 'required',
            'unitary_price' => 'required',
            'user_id' => 'required',
            'company_id' => 'required',
        ]);
       
        if($validator->fails()){
            return $this->error("Data invalid",422, $validator->errors());
        }
        $validated = $validator->validated();
        $updated = $product->update([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'quantity' => $validated['quantity'],
            'unitary_price'=> $validated['unitary_price'],
            'user_id' => $validated['user_id'],
            'company_id' => $validated['company_id'],
        ]);

        if(!$updated)
        {
            return $this->error('Something wrong',400);
        }
        return $this->response("Product Updated",200,$request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $deleted = $product->delete();
        if($deleted)
        {
            return $this->response('Product deleted',200);
        }
        return $this->error('Product not deleted',400);
    }
}
