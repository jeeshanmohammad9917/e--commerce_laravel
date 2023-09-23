@extends('layout_user')
@section('content')

<div class="login">
  <form action="{{route('login_auth')}}" method="POST">
    @csrf
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
      <h2>Login Account</h2>    

        <div class="login-box">
                     <label for="email">Email:</label>
                      <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    <label for="password">Password:</label>
                    <div class="password-container">
                      <input type="password" id="password" name="password" placeholder="Enter your password" class="myellip" required>
                      <i class="fas fa-eye-slash show-password-icon" id="togglePassword"></i>
                    </div>
                         <br>
                        </div> <br>
                        <input type="submit" id="submit" name="submit"> <br>
                        <div class="small"><a href="{{Route('register')}}">Create an account?</a> <a href="{{route('forgotpassword')}}">Forgot Password</a></div>
                       </div>

      
  </form>
  
</div>
 


@endsection