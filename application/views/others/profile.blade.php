@layout('templates.template')

@section('content')
<div class="span4 offset4">
  <p class="lead">@{{ $username; }} ha escrito</p>
<div class="row">
  <div class="span4 well">
    <div class="row">
      <div class="span1">
        <a href="{{action('others@show', array($username));}}" class="thumbnail">
          <img src="../img/user.jpg" alt="">
        </a>
      </div>
      <div class="span3">
        <h1>{{ $name }} </h1> 
        <h3>@{{ $username; }}</h3>
        @if ( Auth::user() && ($following == false))
          {{ Form::open('user/follow', 'POST');}}
          {{ Form::token(); }}
          {{ Form::hidden('id', $user_id, array('id'=>'postvalue')); }}
          {{ Form::submit('Seguir');}}
          {{ Form::close();}}
        @endif
        @if ( Auth::user() && ($following == true))
          {{ Form::open('user/unfollow', 'POST');}}
          {{ Form::token(); }}
          {{ Form::hidden('id', $user_id, array('id'=>'postvalue')); }}
          {{ Form::submit('Siguiendo');}}
          {{ Form::close();}}
        @endif
        <span class="label label-info">Seguidores {{ $followers }}</span>
        <span class="label label-warning">{{ $count }} nimkus</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="span4 well">
    <p class="lead"> Nimkus anteriores</p>

    @foreach ($nimkus -> results as $nimku)
      <hr />
      <div>
        <p>{{ $nimku->nimku }}</p>
        <a href="{{action('nimku@show', array($nimku->id));}}" class="badge pull-right" title="{{ $nimku->updated_at }}">{{ Date::torelative($nimku->updated_at) }}</a>
        <p>&nbsp;</p>
      </div>
    @endforeach
    <hr />
    {{ $nimkus -> pager(true); }}
  </div>
</div>
</div>
@endsection

@section('scripts')
  {{ HTML::script('js/charcounter.js');}}
  {{ HTML::script('js/app.js');}}
@endsection