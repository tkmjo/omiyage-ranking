@extends('layouts.app')

@section('content')
<h2 class="content-top top-title">お気に入りのおみやげ</h2>

<div class="row">
    @foreach ($favoriting as $favorite)
        <a href="{{ route('omiyages.show', $favorite->id) }}">
            <div class="omiyage">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="wrapper panel panel-default">
                        <div class="center-box">
                            <img src="https://placehold.jp/358x450.png">
                        </div>
                        <div class="label">
                            <span class="smoke-label"><a href="{{ route('omiyages.show', $favorite->id) }}">{{ $favorite->omiyage_name }}</a></span><br><br>
                            <span class="smoke-label">{{ $favorite->prefecture }}</span>
                        </div>
                    </div>
                </div>    
            </div>
        </a>
    @endforeach
</div>
@endsection