@layout('templates.template')
@section('content')
<div class="span4 offset4">
  <div class="row">
    <div class="span4">
      <p class="lead">Iniciar sesión</p>
      {{ Form::open('home/login', 'POST',array('class'=>'well')); }}
        {{ Form::token() }}
        @if (Session::has('error_login'))
            {{ Alert::error("Usuario o contraseña incorrecta.") }}
        @endif

        @if (Session::has('success_message'))
            {{ Alert::success("Cuenta creada, ya puedes ingresar!") }}
        @endif

        @if (Session::has('logout_message'))
            {{ Alert::success("Te has desconectado correctamente!") }}
        @endif
        {{ Form::text('username', Input::old('username'), array('class' => 'span3', 'placeholder' => 'Usuario'));}}
        {{ Form::password('password', array('class' => 'span3', 'placeholder' => 'Contraseña'));}}
        {{ Form::labelled_checkbox('remember', 'Recordarme');}}
        {{ Form::submit('Entrar', array('class'=>'btn-info'));}}
      {{ Form::close() }}
    </div>
  </div>
</div>
@endsection