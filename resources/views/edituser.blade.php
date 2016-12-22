@extends('/layouts.new')
@section('content')
{{ Form::open(array('url' =>"edit/".$data->id)) }}
{{csrf_field()}}
{{ Form::label('name')}}<br>
{{ Form::text('name', $data->name,array(
    'class' => 'firstname',
    'id' => 'firstname',
    'placeholder' => 'Name'))}}<br>
  <div class=errors>
 {{ $errors->first('username')}}<br> </div>


{{ Form::label('E-mail')}}<br>
{{ Form::text('email', $data->email ) }}<br>
  <div class=errors>
 {{ $errors->first('email')}}<br></div>

{{ Form::label('Password')}}<br>
{{ Form::password('password')}}<br>
 <div class=errors>
 {{ $errors->first('password')}}<br> </div>
{{ Form::submit('Submit') }}
{{ Form::close()}}
@endsection