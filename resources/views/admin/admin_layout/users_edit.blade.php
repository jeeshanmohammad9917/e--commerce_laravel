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
        <h1 class="mt-4">Users</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin_user_list')}}">User List</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4">
                        <div class="card-header"><h5>Profile Picture</h5></div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img class="img-account-profile rounded-circle mb-2"
                                 src="{{ asset('profiles') . '/' . $user->profile }}" alt="" style="width:50% ; height:50%">
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <form method="POST" action="{{route('admin_user_profile_update' , ['id' => $user->id])}}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="file" class="form-control" id="profile" name="profile"
                                               placeholder="profile">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="submit" name="update" id="update" value="Update Profile Image"
                                               class="btn btn-outline-primary">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header"><h5>Account Details</h5></div>
                        <div class="card-body">
                        <form method="POST" action="{{route('admin_user_update' , ['id' => $user->id])}}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="fname" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="fname" name="fname"
                                               placeholder="Mohammad" value="{{$user->fname}}"
                                               required="">
                                    </div>
                                    <div class="col">
                                        <label for="lname" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lname" name="lname"
                                               placeholder="zeeshan" value="{{$user->lname}}"
                                               required="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="name@example.com" required="" value="{{$user->email}}">
                                    </div>
                                    <div class="col">
                                        <label for="contact" class="form-label">Contact Number</label>
                                        <input type="tel" class="form-control" id="contact" name="contact"
                                               placeholder="1234567890" required="" value="{{$user->contact}}"
                                        >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                    <label for="gender" class="form-label">Role</label><br>
                                        <input type="radio" id="gender" name="role_id"
                                               value="1" @if($user->role_id == '1'){{'checked'}} @endif> &nbsp;&nbsp;Admin&nbsp;&nbsp;
                                        <input type="radio" id="gender" name="role_id"
                                        value="0" @if($user->role_id == '0'){{'checked'}} @endif> &nbsp;&nbsp;User&nbsp;&nbsp;
                                      <br>
                                        <label for="gender" class="form-label">Gender</label><br>
                                        <input type="radio" id="gender" name="gender"
                                               value="Male" @if($user->gender == 'Male'){{'checked'}} @endif> &nbsp;&nbsp;Male&nbsp;&nbsp;
                                        <input type="radio" id="gender" name="gender"
                                               value="Female" @if($user ->gender == 'Female'){{'checked'}} @endif >&nbsp;&nbsp;Female
                                    </div>
                                    <div class="col">
                                        <label for="inputCountry" class="form-label">Country</label>
                                        <select class="form-select" id="inputCountry"
                                                aria-label="Default select example"
                                                required="" name="country">
                                                <option value="">{{$user->country}}</option>
                                                <option value="india">india</option>
                                                <option value="pak">pak</option>
                                                <option value="usa">usa</option>                                   
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" rows="3" name="address"
                                                  placeholder="address" required="">{{$user->address}}</textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <input type="submit" name="update" id="update" value="Update Profile"
                                           class="btn btn-outline-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
    
@endsection
