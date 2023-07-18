@extends('layout_user')
@section('content')


<div class="login">
                                @include('flash_data')
                                @if($errors->any())
                                <div class="alert alert-danger">
                                  <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                  </ul>
                                </div>
                                @endif
<form method="POST" action="{{route('send_forgot_password_email')}}"
                                  enctype="multipart/form-data">
                                @csrf
                            
                                <h2>Forgot Password</h2>    
                               
        <div class="login-box">
                     <label for="email">Email:</label>
                      <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    <br>
                        </div> <br>
                        <input type="submit" id="submit" name="submit" value="Send Email"> <br>
                        

      
  </form>
</div>
@endsection