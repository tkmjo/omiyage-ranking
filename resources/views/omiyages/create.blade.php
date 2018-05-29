@extends('layouts.app')

@section('content')
<div class="row content-top">
    <div class="col-xs-offset-1 col-xs-9">
        <h2 class="top-title">おみやげの追加</h2>
        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['route' => 'omiyages.store']) !!}
                    <div class="form-group">
                        {!! Form::label('omiyage_name', '商品名') !!}
                        {!! Form::text('omiyage_name', old('omiyage_name'), ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('shop_name', '購入店舗') !!}
                        {!! Form::text('shop_name', old('shop_name'), ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group num">
                        {!! Form::label('price', '価格') !!}
                        {!! Form::number('price', old('price'), ['class' => 'form-control nobr']) !!} 円
                    </div>
                    
                    <div class="form-group num">
                        {!! Form::label('quantity', '数量') !!}
                        {!! Form::number('quantity', old('quantity'), ['class' => 'form-control nobr']) !!} 個入
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('prefecture', '都道府県') !!}
                        {!! Form::text('prefecture', old('prefecture'), ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('description', '説明') !!}
                        {!! Form::text('description', old('description'), ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('url', '商品URL') !!}
                        {!! Form::text('url', old('url'), ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="text-right">
                        {!! Form::submit('投稿', ['class' => 'btn btn-success']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection