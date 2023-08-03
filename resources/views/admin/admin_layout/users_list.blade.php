@extends('admin.layout_admin')
@section('content')

<main>
    @include('flash_data')
            <div class="container-fluid px-4">
                <h1 class="mt-4">Users List</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('brands.index')}}">Brands List</a></li>
                    <li class="breadcrumb-item active">Users List</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        All Users
                        <a href="{{route('admin_user_profile_register')}}" class="btn btn-outline-primary btn-sm float-end"> + Add User</a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" cellpadding="10px">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Contact</th>
                                <th>Gender</th>
                                <th>address</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <!-- <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Contact</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                            </tfoot> -->
                            <tbody>
                                @foreach($users as $user)
                            <tr >
                                <td>{{$user->FullName}}</td>
                                <td>{{$user->email}}</td>
                                <th>{{$user->role_name}}</th>
                                <td>{{$user->contact}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->country}}</td>
                                <td style="max-width: 30px ;  display:flex ">
                                    <a href="{{route('admin_user_edit' , ['id'=>$user->id])}}" class="btn btn-sm btn-warning" style="margin-right: 10px" target="_blank">Edit</a>
                                    <a href="{{route('admin_change_user_status' , ['id'=>$user->id , 'status' =>$user->is_active == 1 ? 0 : 1])}}" class="btn btn-sm btn-danger {{ $user -> is_active == 1 ? 'danger' : 'success'}}"> {{ $user->is_active == 1 ? 'Deactivate' : 'Active'}}</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
 @endsection       