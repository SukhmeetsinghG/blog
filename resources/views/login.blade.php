@extends('/layouts.layout')
@section('content')  
 <script src="{{asset('js/jquery.js')}}"></script>
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>

<script src="{{asset('js/additional-methods.js')}}"></script>

<script type="text/javascript">
        $(document).ready(function() { 
            $("#register").validate({
                 rules: {

               name:{
                    required: true,
                    lettersonly : true
               },
               email: {
                    required: true,
                    email:true
               },
               password:{
                  required: true,
                  alphanumeric: true
               },
            },
            messages: { 
               name:{
                         required: "*Name field cannot be empty",
                         lettersonly: "*Name should be in alphabets only"
                        },
               email: {
                      required: "*Email field cannot be empty",
                      email: "*Invalid email address"
                      },
               password:{
                          required: "*Password field cannot be empty",
                          alphanumeric: "*Letters, numbers, and underscores only please"
                        },
              },
              errorClass: "errors"            
        });

            $("#email1").on('blur', function(event){
            var emailname = $("#email1").val();
            
            alert(emailname);
            $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url : "{{url('/checkmail')}}",
              data: {'emailname': emailname},
              type: 'POST',
              success: function(result){
                if(result){
                  
                  $('.emailerror').html(result);
                }else{
                  $('.emailerror').html('');
                }
              }
            })
          });

    });
    </script>     
<style>
.errors{
    color:red;
}
</style>
       <section id="form"><!--form-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-1">
                        <div class="login-form"><!--login form-->
                            <h2>Login to your account</h2>
                            <form method="POST" action="{{url('auth/login')}}">
                                {!! csrf_field() !!}
                                <input type="email" name="email" id="email" placeholder="Email Address" />
                                   {{ $errors->first('email')}}
                                <input type="password" name="password" id="password" placeholder="Password" />
                                <span>
                                    <input name="remember" id="remember" type="checkbox" class="checkbox"> 
                                    Keep me signed in
                                </span>
                                <button type="submit" class="btn btn-default">Login</button>
                            </form>
                        </div><!--/login form-->
                    </div>
                    <div class="col-sm-1">
                        <h2 class="or">OR</h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="signup-form"><!--sign up form-->
                            <h2>New User Signup!</h2>
                            <form method="POST" action="{{url('register')}}" name="register" id="register">
                                {!! csrf_field() !!}
                                <input type="text" name="name" id="name"  placeholder="Name" value="{!! old('name') !!}">
                                <div class=errors>
                                {{ $errors->register->first('name')}}
                                </div>
                                <input type="email" name="email" placeholder="Email Address" id="email1"/>
                                <div class=error>
                                <span class="emailerror" style="color: red;"></span>
                                {{ $errors->register->first('email') }} </div>
                                <input type="password" name="password" placeholder="Password">
                                <div class=error>
                                {{ $errors->register->first('password')}}
                                </div>
                                <button type="submit" class="btn btn-default">Signup</button>
                            </form>
                        </div><!--/sign up form-->


                       
                      
                    </div>
                </div>
            </div>
        </section><!--/form-->
@endsection
