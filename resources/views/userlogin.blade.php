@extends('/layouts.new')
@section('content')

{{ Form::open(array('url' => 'practice/pract-login')) }}
{{csrf_field()}}
{{ Form::label('E-mail')}}<br>
{{ Form::text('email', 'example@gmail.com' ) }}<br>
  <div class=errors>
 {{ $errors->first('email')}}<br></div>
{{ Form::label('Password')}}<br>
{{ Form::password('password') }}<br>
 <div class=errors>
 {{ $errors->first('password')}}<br> </div>
{{ Form::submit('Login') }}
<a href="{{url('redirect/facebook')}}"><i class="fa fa-facebook-square" aria-hidden="true"></i>
</a>
<a href="{{url('redirect/google')}}">G+</a>
{{ Form::close()}}
<a href="{{ url('practice')}}">Register</a>
@endsection 