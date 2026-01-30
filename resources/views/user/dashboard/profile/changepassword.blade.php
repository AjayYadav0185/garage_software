@extends('user.dashboard.layout.master')
@section('user-contant')
    <div class="main-content supreme-container">
        <section class="section " style="margin-top:-34px;">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Change Password</h4>
                            </div>
                            {{-- @if (session('alert'))
                                <div class="alert alert-warning">
                                    {{ session('alert') }}
                                </div>
                            @endif
                            @if ($errors->any())
                              <div class="alert alert-danger">
                                 <ul>
                                       @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                       @endforeach
                                 </ul>
                              </div>
                           @endif --}}

                           {{-- Notification --}}
                           <div class="col-md mb-4 mb-md-0">
                           
                            @if($errors->any())
                                          <div id="err" style="color: red">
                                          <div class="alert alert-danger">{{$errors->first()}}</div>
                                          </div>
                                      @endif
                                                    
                                      <div id="err" style="color: red">
                                          @if(session()->has('error'))
                                          <div class="alert alert-danger">{{ session('error') }}</div>
                                          @endif
                                      </div>
                                                      
                                      <div id="err" style="color: ">
                                          @if(session()->has('success'))
                                          <div class="alert alert-success">{{ session('success') }}</div>
                                          @endif
                                      </div>
          
                              </div>

                        {{-- Notification --}}
                            
                            <div class="card-body">
                                
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                        aria-labelledby="home-tab3">
                                        <div class="card col-md-10 ">
                                            
                                            <div class="card-body">

                                                

        <form method="post" id="changepasswordform" action="{{route('user.verify-change-password')}}">
                                                  
            {!! csrf_field() !!}
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Old Password<span class="text-danger">*</span></label>
                    <input type="password"  name="old_password" id="old_password" class="form-control" onKeyPress="if(this.value.length==50) return false;" required="" >
                    @error('old_password')
                            <p style="color: red;">{{ $message }}</p>
                        @enderror
                </div>
            </div>

                <div class="row">
                <div class="form-group col-md-6">
                    <label>New Password<span class="text-danger">*</span></label>
                    <input type="password" name="new_password" id="new_password" class="form-control password-input" 
                        onKeyPress="if(this.value.length==50) return false;" required="" >
                        @error('new_password')
                            <p style="color: red;">{{ $message }}</p>
                        @enderror
                        <span id="password-hint" class="text-info" style="font-size:13px" >
                              Password should contains numbers, letters, and special characters.
                        </span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Confirm Password<span class="text-danger">*</span></label>
                    <input type="password" name="confirm_password" id="confirm_password"
                        class="form-control" onKeyPress="if(this.value.length==50) return false;" required="" >
                        @error('confirm_password')
                            <p style="color: red;">{{ $message }}</p>
                        @enderror
                </div>
                
            </div>
            
            <input type="submit" name="submit" class="btn btn-primary"
                class="btn btn-primary mr-1" value="Change Password">
            
        </div>
    </form>
                                        </div>
                                    </div>
                                    

                                    


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <script>
        $(document).ready(function() {
    
                                        $('.password-input').on('input', function() {
                                        var password = $(this).val();
                                        
                                        var strength = checkPasswordStrength(password);
                                            
                                        var hint = getPasswordHint(strength);
                                        $('#password-hint').text('' + hint);
                                        });
                                        function checkPasswordStrength(password) {
                                        var strength = '';
                                        
                                        if (password.length >= 8) {
                                            strength += 'Length: Strong, ';
                                        } else {
                                            strength += 'Length: Weak, ';
                                        }
                                        
                                        if (/[A-Z]/.test(password)) {
                                            strength += 'Uppercase: Strong, ';
                                        } else {
                                            strength += 'Uppercase: Weak, ';
                                        }
                                        
                                        if (/[a-z]/.test(password)) {
                                            strength += 'Lowercase: Strong, ';
                                        } else {
                                            strength += 'Lowercase: Weak, ';
                                        }
                                        
                                        if (/\d/.test(password)) {
                                            strength += 'Number: Strong, ';
                                        } else {
                                            strength += 'Number: Weak, ';
                                        }
                                        
                                        if (/[^A-Za-z0-9]/.test(password)) {
                                            strength += 'Special character: Strong';
                                        } else {
                                            strength += 'Special character: Weak';
                                        }
                                        
                                        return strength;
                                        }
    
                                        function getPasswordHint(strength) {
                                        if (strength.includes('Weak')) {
                                            return 'Your password is weak. Please make sure it has at least 8 characters, including one uppercase letter, one lowercase letter, one number, and one special character.';
                                        } else if (strength.includes('Strong')) {
                                            return 'Your password is strong.';
                                        } else {
                                            return 'Your password is okay, but it can be stronger. Try including at least 8 characters, including one uppercase letter, one lowercase letter, one number, and one special character.';
                                        }
                                        }
    });
    </script>
@endsection
