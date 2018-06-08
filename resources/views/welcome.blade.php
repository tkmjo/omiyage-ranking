@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1>全国の人気のおみやげが知りたい</h1>
                    <select class="btn btn-success btn-lg prefecture-button" onchange="top.location.href=value">
                        <option value="">ランキングを見る</option>
                        @foreach(config('pref') as $index => $name)
                            <option value="{{ route('ranking.rank', $name) }}">{{ $name }}</option>
                        @endforeach
                    </select>
                {{--
                <a href="" class="btn btn-success btn-lg">ランキングを見る</a>
                --}}
            </div>
        </div>
    </div>
@endsection

@section('content')
    <h2 class="top-title welcome">おみやげ一覧</h2>
    @include('omiyages.omiyages')
    <div class="text-center">
        {!! $omiyages->render() !!}
    </div>
@endsection