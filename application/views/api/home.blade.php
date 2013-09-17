@layout('templates.template')

@section('content')
<div class="span8 offset2">
    <div class="row artwork hidden-phone" style="font-size:80px; text-align: center;">
		<div class="masthead">
			<h1>API de Nimku<h1>
		</div>
	</div>
	<hr />
	<div class="row">
		<div class="span6">
		<p class="lead">Usos de la API</p>
		<p>La API de Nimku provee diferentes métodos para su utilización, los cuales detallamos a continuación:</p>
		<ul>
			<li><a href="{{action('api@nimkus');}}"> /api/nimkus - Todos los Nimkus</a></li>
			<li><a href="{{action('api@users');}}"> /api/users - Todos los Usuarios</a></li>
			<li><a href="{{action('api@nimkusbytext', 'palabras') }}"> /api/search/nimkus/(:any) - Buscar Nimkus por palabras clave</a></li>
			<li><a href="{{action('api@usersbyname', 'nombre') }}"> /api/search/users/(:any) - Buscar Usuarios por nombre</a></li>
		</ul>

		</div>
	</div>
</div>
@endsection