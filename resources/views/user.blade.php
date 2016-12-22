@extends('/layouts.new')
@section('content')

{{ Form::open(array('url' => 'pract-reg')) }}
{{csrf_field()}}
{{ Form::label('username')}}<br>
{{ Form::text('username', null,array(
    'class' => 'firstname',
    'id' => 'firstname',
    'placeholder' => 'Name',
    'value' => 'old("username")')) }}<br>
  <div class=errors>
 {{ $errors->first('username')}}<br> </div>


{{ Form::label('E-mail')}}<br>
{{ Form::text('email', 'example@gmail.com' ) }}<br>
  <div class=errors>
 {{ $errors->first('email')}}<br></div>
{{ Form::label('Password')}}<br>
{{ Form::password('password') }}<br>
 <div class=errors>
 {{ $errors->first('password')}}<br> </div>

                            <div>

                                {!! app('captcha')->display() !!}

                              
                           


                                @if ($errors->has('g-recaptcha-response'))

                                    <span class="help-block">

                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>

                                    </span>

                                @endif

                            </div> <br>
     <div>                       
{{ Form::submit('Submit') }} </div>
{{ Form::close()}}
@endsection 