@if (Auth::user())
    @if (Auth::user()->is_favoriting($omiyage->id))
        <div class="text-center">
            {!! Form::open(['route' => ['user.unfavorite', $omiyage->id], 'method' => 'delete']) !!}
                {!! Form::submit('お気に入りから削除', ['class' => "btn btn-danger contribution_danger"]) !!}
            {!! Form::close() !!}
        </div>
    @else
        <div class="text-center">
            {!! Form::open(['route' => ['user.favorite', $omiyage->id]]) !!}
                {!! Form::submit('お気に入り', ['class' => 'btn btn-success contribution_success']) !!}
            {!! Form::close() !!}
        </div>
    @endif
@endif