@extends('layouts.app')

@section('content')
    <h2 class="content-top top-title">あなたのお気に入り</h2>
    @include('omiyages.omiyages')
    <div class="text-center">
        {!! $omiyages->render() !!}
    </div>
@endsection