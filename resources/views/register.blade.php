
@extends('layout_user')
@section('content')


<div class="reg">
          
        <form method="POST" action="{{Route('store_user')}}" enctype="multipart/form-data">
          @csrf
        @if($errors->any())
                 <div class="alert alert-danger">
                  <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                  </ul>
                 </div>
                @endif
                  <div class="form-box">
                    <div class="left">
                  
                        <label for="first name">First name:</label>
                        <input type="text" id="first name" name="fname" placeholder="Enter your first name" required>
                  
                    
                          <label for="email">Email:</label>
                          <input type="email" id="email" name="email" placeholder="mystore@gmail.com" required>
                          <label for="password">Password:</label>
                          <div class="password-container">
                            <input type="password" id="password" name="password" placeholder="password" required>
                            <i class="fas fa-eye-slash show-password-icon" id="togglePassword"></i>
                          </div>
                          <label for="address">Address:</label> 
                            <textarea name="address" id="address" ></textarea>
                            <div class="upload-container">
                                <label for="file-upload" class="custom-file-upload">
                                  <i class="fas fa-cloud-upload-alt"></i> Choose File
                                </label>
                                <input id="file-upload" type="file" name="profile"/>
                              </div> 
                      
                    </div>
                
              
                      <div class="right">
                    
                            <label for="lastName">Last Name:</label>
                            <input type="text" id="lastName" name="lname" placeholder="Enter your last name" required>
                
                            <label for="contactNumber">Contact Number:</label>
                            <input type="tel" id="contactNumber" name="contact" placeholder="Enter your contact number" required>
                            <label for="country">Country:</label> 
                            <select id="country" name="country" required>
                              <option value="">Select</option>
                            <option value="india">india</option>
                            <option value="pak">pak</option>
                              <option value="usa">usa</option>
                            </select>
                            <label for="gender">Gender:</label> 
                            <input type="radio" id="gender" name="gender" value="male"required> Male
                              <input type="radio" id="gender" name="gender" value="Female"  required> Female
                      </div>
                    </div>
                  <br>
                  <input type="submit" id="submit" name="submit"> 
                  <br>
                  <div class="small"><a href="{{Route('login')}}">Have an account? Go to login</a></div>

            
        </form>
      </div>
@endsection
