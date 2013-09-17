@layout('templates.template')

@section('content')
<div class="span6 offset3 well">
  <p class="lead">Se han escrito {{$count;}} nimkus</p>
  @foreach ($nimkus -> results as $nimku)
    <hr />
    <div class="row">
      <div class="span1"><a href="{{action('others@show', array($nimku->user->username));}}" class="thumbnail"><img src="img/user.jpg" alt=""></a>
      </div>
      <div class="span5">
        <h3><a href="{{action('others@show', array($nimku->user->username)); }}">{{ $nimku->user->username }}</a></h3>
        <p>{{ $nimku->nimku; }}</p>
        <a href="{{action('nimku@show', array($nimku->id));}}" class="badge pull-right" title="{{ $nimku->updated_at }}">{{ Date::torelative($nimku->updated_at) }}</a>
        <span class="badge badge-warning">{{ Nimku::where('user_id','=',$nimku->user->id)->count(); }} nimkus</span>
        <span class="badge badge-info">{{ Follower::where('following_id','=',$nimku->user->id)->count(); }} seguidores</span>
      </div>
    </div>
  @endforeach
  <hr />
  {{ $nimkus -> pager(true); }}
</div>
@endsection