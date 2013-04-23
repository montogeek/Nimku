@layout('templates.template')

@section('content')
<div class="span8 offset2">
    <div class="row artwork hidden-phone" style="font-size:80px; text-align: center;">
		<div class="masthead">
			<h1>Nimku<h1>
		</div>
	</div>
	<hr />
	<div class="row">
		<div class="span4">
		<p class="lead">Ingresar</p>
			{{ Form::open('home/login', 'POST',array('class'=>'well')); }}
			{{ Form::token() }}
			@if (Session::has('error_login'))
			{{ Alert::error("Usuario o contraseña incorrecta.") }}
			@endif
			{{ Form::text('username', Input::old('username'), array('class' => 'span3', 'placeholder' => 'Usuario'));}}
			{{ Form::password('password', array('class' => 'span3', 'placeholder' => 'Contraseña'));}}
			{{ Form::labelled_checkbox('remember', 'Recordarme');}}
			{{ Form::submit('Entrar', array('class'=>'btn-info'));}}
			{{ Form::close() }}
		</div>
		<div class="span4">
			<p class="lead">¿Eres nuevo? Regístrate!</p>
			{{ Form::open('/', 'POST',array('class'=>'well')); }}

			{{ Form::token(); }}

			{{ $errors->first('name', Alert::error(":message")) }}
			{{ Form::text('name', Input::old('name'), array('class' => 'span3', 'placeholder' => 'Nombre'));}}

			{{ $errors->first('username', Alert::error(":message")) }}
			{{ Form::text('nuevo_username', Input::old('new_username'), array('class' => 'span3', 'placeholder' => 'Usuario'));}}

			{{ $errors->first('password', Alert::error(":message")) }}
			{{ Form::password('nuevo_password', array('class' => 'span3', 'placeholder' => 'Contraseña'));}}
			
			{{ Form::submit('Regístrate', array('class'=>'btn-primary'));}}
			{{ Form::close() }}
		</div>
	</div>
</div>
@endsection