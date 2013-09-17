@layout('templates.template')

@section('content')
<div class="span4 offset4">
<div class="row">
  <div class="span4 well">
    <div class="row">
      <div class="span1">
        <a href="{{action('others@show', array($username));}}" class="thumbnail">
          <img src="../img/user.jpg" alt="">
        </a>
      </div>
      <div class="span3">
        <h4>@{{ $username; }} ha escrito</h4>
        <p>{{ $nimku }}</p>
        <span class="badge pull-right" title="{{ $updated_at }}">{{ Date::torelative($updated_at) }}</span>

      </div>
    </div>
  </div>
</div>

</div>
@endsection

@section('scripts')
  {{ HTML::script('js/charcounter.js');}}
  {{ HTML::script('js/app.js');}}
@endsection