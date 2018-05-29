@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1>地域ごとの人気のおみやげが知りたい</h1>
                <a href="" class="btn btn-success btn-lg">ランキングを見る</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @include('omiyages.omiyages')
@endsection