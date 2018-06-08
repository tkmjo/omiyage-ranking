@extends('layouts.app')

@section('content')
    <div class="row content-top">
        <div class="col-xs-8">
            <h2 class="top-title">{{ $omiyage->omiyage_name }}</h2>
            {{-- <img src="https://placehold.jp/500x500.png"> --}}
            @if ($omiyage->filename)
                <img src="{{ asset('storage/image/show-resized/' . $omiyage->filename) }}" alt="image" />
            @endif
            
            <table class="table item_detail">
                <tbody>
                <tr>
                    <td class="data_name">商品名</td>
                    <td>{{ $omiyage->omiyage_name }}</td>
                </tr>
                <tr>
                    <td class="data_name">購入店舗</td>
                    <td>{{ $omiyage->shop_name }}</td>
                </tr>
                <tr>
                    <td class="data_name">価格</td>
                    <td>{{ $omiyage->price }} 円</td>
                </tr>
                <tr>
                    <td class="data_name">個数</td>
                    <td>{{ $omiyage->quantity }} 個入</td>
                </tr>
                <tr>
                    <td class="data_name">都道府県</td>
                    <td>{{ $omiyage->prefecture }}</td>
                </tr>
                <tr>
                    <td class="data_name">商品のurl</td>
                    <td>{{ $omiyage->url }}</td>
                </tr>
                </tbody>
            </table>
            <div class="description_item">
                <h3>商品の説明:</h3>
                <td>{{ $omiyage->description }}</td>
            </div>
            @include('user_favorite.favorite_button', ['omiyage' => $omiyage])
        </div>
    </div>
@endsection