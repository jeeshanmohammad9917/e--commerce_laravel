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
        <h1 class="mt-4">Brands</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin_user_list')}}">User List</a></li>
                    <li class="breadcrumb-item active">Brand List</li>
                </ol>
                <div class="card mb-4" >
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        All Brands
                        <a href="{{route('brands.create')}}" class="btn btn-outline-primary btn-sm float-end"> + Add Brand</a>
                    </div>
                    <div class="card-body" >
                        <table id="datatablesSimple" style="width: 100%;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                                @foreach($brands as $brand)
                            <tr>
                                <td>{{$brand->name}}</td>
                                <td><img src="{{ url('brands') . '/' . $brand->image }}" alt="{{ $brand->name ?? 'Brand' }} Image" width="100"></td>
                                <td> {{$brand->description}}</td>

                                <td style="max-width: 30px">
                                    <a href="{{route('brands.edit' , ['brand'=>$brand->id])}}" class="btn btn-sm btn-warning" style="margin-right: 10px" target="_blank">Edit</a>
                                    <a href="{{ route('admin_change_brand_status', ['id' => $brand->id, 'status' => $brand->is_active == 1 ? 0 : 1]) }}" class="btn btn-sm btn-{{ $brand->is_active == 1 ? 'danger' : 'success' }}">{{ $brand->is_active == 1 ? 'Deactivate' : 'Activate' }}</a>

                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        
    
@endsection
