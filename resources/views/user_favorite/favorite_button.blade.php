@if (Auth::user())
    @if (Auth::user()->is_favoriting($omiyage->id))
        {!! Form::open(['route' => ['user.unfavorite', $omiyage->id], 'method' => 'delete']) !!}
            {!! Form::submit('お気に入りを解除', ['class' => "btn btn-danger btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['user.favorite', $omiyage->id]]) !!}
            {!! Form::submit('お気に入り', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    @endif
@endif