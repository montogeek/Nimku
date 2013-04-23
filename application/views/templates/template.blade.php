<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Nimku</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{ URL::base(); }}/css/font-awesome.min.css" rel="stylesheet" >
    <link href="{{ URL::base(); }}/css/bootstrap.min.css" rel="stylesheet" >
    <link href="{{ URL::base(); }}/css/bootstrap-responsive.min.css" rel="stylesheet" >
    <style>
      .artwork {
        margin-top:30px;
        margin-bottom: 30px;
      }
      .masthead h1{
        font-size: 120px;
        line-height: 1;
        letter-spacing: -2px;
      }
    </style>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
<body>
    <div class="navbar">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="{{ URL::base(); }}">Nimku</a>
          <div class="nav-collapse">
            <ul class="nav pull-right">
              @if (Auth::guest())
                <li class="divider-vertical"></li>
                <li class="dropdown visible-desktop">
                  <a class="dropdown-toggle" href="#" data-toggle="dropdown">Ingresar <strong class="caret"></strong></a>
                  <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                    {{ Form::open('home/login', 'POST',array('class'=>'')); }}
                    {{ Form::token() }}
                    {{ Form::text('username', Input::old('username'), array('class' => 'span2', 'placeholder' => 'Usuario'));}}
                    {{ Form::password('password', array('class' => 'span2', 'placeholder' => 'Contraseña'));}}
                    {{ Form::submit('Entrar', array('class'=>'btn-info'));}}
                  {{ Form::close() }}
                  </div>
                </li>
              @else
              <li>{{ HTML::link_to_action('user@index', Auth::user()->username) }} </li>
              <li>{{ HTML::link_to_action('home@logout', 'Salir') }}</li>
              @endif
            </ul>
            <ul class="nav">
              <li class="active"><a href="{{URL::base();}}">Inicio</a></li>
              @if (!Auth::guest())
                <li>{{ HTML::link_to_action('user@index', "Perfil") }} </li>
              @endif
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        @yield('content')
      </div>
    </div>
  {{ Asset::container('bootstrapper')->scripts(); }}
  @section('scripts')
  @yield_section
  </body>
</html>