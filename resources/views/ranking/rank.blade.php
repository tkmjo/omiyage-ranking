@extends('layouts.app')

@section('content')
    @if (count($omiyages) > 0)
    <h2 class="content-top top-title">{{ $omiyages->first()->prefecture }}の人気おみやげランキング</h2>
    <div class="row">
        <?php $rank_num = 0 ?>
        @foreach ($omiyages as $omiyage)
        <?php
            if ($rank_num < count($omiyages)) {
                $rank_num += 1;
            }
        ?>
            <a href="{{ route('omiyages.show', $omiyage->id) }}">
                <div class="omiyage">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <div class="wrapper panel panel-default">
                            <div class="prefecture-ranking left-box">
                                <img src="https://placehold.jp/315x250.png">
                            </div>
                            <div class="rank-badge"><?php echo $rank_num ?></div>
                            <div class="prefecture-ranking right-box">
                                <h2 class="omiyage-name"><a href="{{ route('omiyages.show', $omiyage->id) }}">{{ $omiyage->omiyage_name }}</a></h2>
                                <i class="fas fa-map-marker-alt supplement"></i>&nbsp;<span class="supplement">{{ $omiyage->prefecture }}</span>&emsp;&emsp;&emsp;
                                <span class="supplement">{{ $omiyage->quantity }} 個入 / </span>
                                <span class="supplement">{{ $omiyage->price }} 円</span><br><br>
                                <p class="description">{{ $omiyage->description }}</p>
                                <span class="favorite">{{ $omiyage->count }}人がお気に入りに登録</span>
                            </div>
                        </div>
                    </div>    
                </div>
            </a>
        @endforeach
    </div>
    @else
        <p class="content-top ranking-not-registrated">おみやげが登録されておりません。</p>
    @endif
    
    {{--
    @include('omiyages.omiyages', ['omiyages' => $omiyages])
    --}}
@endsection