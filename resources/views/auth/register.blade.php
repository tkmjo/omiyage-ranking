@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-offset-3 col-xs-6">
        <div class="panel panel-default content-top">
            <div class="panel-heading">会員登録</div>
            <div class="panel-body">
                {!! Form::open(['route' => 'signup.post']) !!}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        {!! Form::label('ユーザー名') !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        {!! Form::label('メールアドレス') !!}
                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        {!! Form::label('パスワード') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-group">
                        {!! Form::label('パスワード（確認）') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="text-center">
                        {!! Form::submit('登録', ['class' => 'btn btn-success contribution_success']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection