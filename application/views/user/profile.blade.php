@layout('templates.template')

@section('content')
  <div class="span4 offset4">
    <p class="lead">¿En qué estás pensando, {{ Auth::User()->name }} ?</p>
    <div class="row">
      <div class="span4 well">
      {{ Form::open('user/index', 'POST'); }}
        {{ Form::token() }}
        {{ $errors->first('nimku', Alert::error(":message")) }}
        {{ Form::textarea('new_nimku', Input::old('new_nimku'), array('class'=>'span4','id'=>'new_nimku','rows'=>'5','placeholder' => 'Publica lo que estás pensando!')); }}
        {{ Form::submit('Publicar Nimku', array('class' => 'btn btn-info')); }}
        {{ Form::close() }}
      </div>
    </div>

    <div class="row">
      <div class="span4 well">
        <div class="row">
          <div class="span1"><a href="{{action('others@show', array(Auth::User()->username));}}" class="thumbnail"><img src="../img/user.jpg" alt=""></a></div>
          <div class="span3">
            <h1>{{ Auth::user()->name}}</h1>
            <h3>@{{ Auth::user()->username }}</h3>
            <span class="label label-info">{{ $followers }} seguidores</span>
            <span class="label label-warning">{{ $count }} nimkus</span>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="span4 well">
        <p class="lead"> Nimkus anteriores:</p>
        @foreach ($nimkus -> results as $nimku)
    		  <hr />
    		  <div>
            <p>{{ $nimku->nimku }}</p>
            <span class="badge pull-right">{{ $nimku->updated_at }}</span>
    			</div>      
    		@endforeach
        <hr/>
        {{ $nimkus -> pager(true); }}
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  {{ HTML::script('js/charcounter.js');}}
  {{ HTML::script('js/app.js');}}
@endsection