<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Models\brand;
use Illuminate\Support\Str;




class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::all();

     return view('admin.product_list', compact('products'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    
    {   
         $brands=brand::all();
        $products = product::all();
        return view('admin.product_add' , compact('products','brands'));    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'color' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'product_code' => 'required|min:5',
            'gender' => 'required|in:male,female,children,unisex',
            'function' => 'nullable|string|max:50',
            'stock' => 'required|numeric',
            'description' => 'required|string|max:500',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except(['_token', 'add_product']);
        $imgName = Str::snake($request->name) . '.' . $request->image->extension();
        $request->image->move(public_path('products/'), $imgName);
        $requestData['image'] = $imgName;
        $product = product::create($requestData);
        return redirect()->route('products.index', [], 301)->with('success', 'Product Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // echo"<pre>";
        // print_r($requestdata);
        // exit;
        $brands = brand::all();
        return view('admin.product_edit', compact('brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'color' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'product_code' => 'required|min:5',
            'gender' => 'required|in:male,female,children,unisex',
            'function' => 'nullable|string|max:50',
            'stock' => 'required|numeric',
            'description' => 'required|string|max:500',
        ]);
        $product->name = $request->name ?? $product->name;
        $product->price = $request->price ?? $product->price;
        $product->sale_price = $request->sale_price ?? $product->sale_price;
        $product->color = $request->color ?? $product->color;
        $product->brand_id = $request->brand_id ?? $product->brand_id;
        $product->product_code = $request->product_code ?? $product->product_code;
        $product->gender = $request->gender ?? $product->gender;
        $product->function = $request->function ?? $product->function;
        $product->stock = $request->stock ?? $product->stock;
        $product->description = $request->description ?? $product->description;
        $product->save();
        return redirect()->route('products.index', [], 301)->with('success', 'Product Created Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //
    }
    public function changeProductStatus(Request $request, $id, $status = 1)
    {
        $product = product::find($id);
        if (!empty($product)) {
            $product->is_active = $status;
            $product->save();
            return redirect()->route('products.index')->with('success', 'Product status Updated Successfully!');
        } else {
            return redirect()->route('products.index')->with('danger', 'Something went wrong.');
        }
    }
}
