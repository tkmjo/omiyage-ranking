@extends('layouts.app')

@section('content')
    @if (count($omiyages) > 0)
    <h2 class="content-top top-title ranking-top">{{ $omiyages->first()->prefecture }}の人気おみやげランキング</h2>
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
                        <div class="wrapper panel panel-default panel-ranking">
                            <div class="prefecture-ranking left-box">
                                <img src="{{ Storage::disk('s3')->url('home/ec2-user/environment/omiyage-ranking/public/storage/image/ranking-resized/' . $omiyage->filename) }}" />
                            </div>
                            <div class="rank-badge"><?php echo $rank_num ?></div>
                            
                            <div class="prefecture-ranking right-box">
                                <h2 class="omiyage-name"><a href="{{ route('omiyages.show', $omiyage->id) }}">{{ $omiyage->omiyage_name }}</a></h2>
                                <div class="price_quantity">
                                    <i class="fas fa-map-marker-alt supplement"></i>&nbsp;<span class="supplement">{{ $omiyage->prefecture }}</span>&emsp;&emsp;&emsp;
                                    <span class="supplement">{{ $omiyage->price }} 円 / </span>
                                    <span class="supplement">{{ $omiyage->quantity }} 個入</span>
                                </div>
                                
                                <?php
                                    // 表示文字数制限処理
                                    if (strlen($omiyage->description) >= 120) {
                                        $omiyage->description = mb_substr($omiyage->description, 0, 120) . '...';
                                    }
                                ?>
                                
                                <p class="description">{{ $omiyage->description }}</p>
                                <div class="favorite">{{ $omiyage->count }}人がお気に入りに登録</div>
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