@extends('admin.layout_admin')
@section('content')
@include('flash_data')
<style>
    body{
        /* margin-top:5%; */
    }
</style>
                                @if($errors->any())
                                <div class="alert alert-danger">
                                  <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                  </ul>
                                </div>
                                @endif
        <!-- Account page navigation-->
        <h1 class="mt-4">Add Brands</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin_user_list')}}">User List</a></li>
                    <li class="breadcrumb-item"><a href="{{route('brands.index')}}">Brands List</a></li>

                    <li class="breadcrumb-item active">Add Brands</li>
                </ol>
                <div class="card mb-4" >
    
                    <div class="album py-5" >
                            <div class="row h-100 justify-content-center align-items-center">
                                <div class="card border-success" style="max-width: 85rem;padding: 2%;">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('brands.update', ['brand' => $brand->id]) }}"
                                      
                                              enctype="multipart/form-data">
                                              @csrf
                                              @method('PUT')
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="name" class="form-label">brand Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                           value="{{$brand->name}}"
                                                           required="">
                                                </div>                                                                                                                                     
                                            </div>
                                           
                                            <div class="row mb-3">
                                                
                                                <div class="col">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea class="form-control" id="description" rows="3"
                                                              name="description"
                                                             value="" required="">{{$brand->description}}</textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="mb-3">
                                                <input type="submit" name="add_product" id="add_product"
                                                value="Add Product"
                                                class="btn btn-outline-success">
                                            </div>
                                        </form>
                                        <form method="POST"
                                        action="{{ route('admin_brand_image_change', ['id' => $brand->id]) }}"
                                        enctype="multipart/form-data">
                                      @csrf
                                      @method('POST')
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="image" class="form-label">Image</label><br>
                                                    <input type="file" class="form-control-file" name="image"
                                                           id="image">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="submit" name="add_product" id="add_product"
                                                    value="change image"
                                                    class="btn btn-outline-success">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
        
    
@endsection
