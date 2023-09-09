<?php

namespace App\Http\Controllers;

use App\Models\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $Request)
    {
        $brands = brand::all();
        return view('admin.admin_layout.brands_list', compact('brands'));

    //  echo"<pre>";
    //     print_r('text');
    //     exit;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin_layout.brands_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|max:20|string',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestdata=$request->except(['_token','add_product']);
        // echo"<pre>";
        // print_r($requestdata);
        // exit;
        $imgname=Str::snake($request->name) .".". $request->image->extension();
        $request->image->move(public_path('brands/'),$imgname);
        $requestdata['image']=$imgname;
        $brand=brand::create($requestdata);
        //    echo"<pre>";
        // print_r($user);
        // exit;
        if(!empty($brand)){
            $brand->update($requestdata);
            return redirect()->route('brands.index')->with('success','brand update successfully.');           
        }
   
        return redirect()->route('brands.index')->with('danger','something went wrong .');           
    }

    /**
     * Display the specified resource.
     */
    public function show(brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(brand $brand )
    { 
        return view('admin.admin_layout.brands_edit', compact('brand'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, brand $brand)
    {    
        $this->validate($request, [
            'name' => 'required|min:2|max:20|string',
            'description' => 'nullable|string|max:100',
        ]);
        $brand->name = $request->name ?? $brand->name;
        $brand->description = $request->description ?? $brand->description;
        $brand->save();
        return redirect()->route('brands.index')->with('success', 'Brand has been updated Successfully!');     

    }

    /**
     * Remove the specified resource from storage.
     */
    public function changeBrandImage(Request $request , $id )
    {
                     
        
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $requestData = $request->except(['_token', '_method', 'add_product']);
        $brand = brand::find($id);
        if (!empty($brand)) {
            $image = $request->file('image');
            $imgName = $image->getClientOriginalName();
            $request->image->move(public_path('brands/'), $imgName);
            $requestData['image'] = Str::snake($imgName);
            $brand->update($requestData);
            return redirect()->route('brands.index')->with('success', 'Brand Image Updated Successfully!');
        } else {
            return redirect()->route('brands.index')->with('danger', 'Something went wrong.');
        }          
    }
    public function changeBrandStatus(Request $Request, $id , $status = 1)
    {
                     
        $brand=brand::find($id);
        if(!empty($brand)){
           $brand->is_active= $status;
           $brand->save();
            return redirect()->route('brands.index')->with('success','Brand Status updated successfully.');           
        }
   
        return redirect()->route('brands.index')->with('danger','Brand Status not updated .');
    }
}
