<div class="row">
    @foreach ($omiyages as $omiyage)
        <a href="{{ route('omiyages.show', $omiyage->id) }}">
            <div class="omiyage">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="wrapper panel panel-default">
                        <div class="center-box">
                            <img src="https://placehold.jp/358x450.png">
                        </div>
                        <div class="label">
                            <span class="smoke-label"><a href="{{ route('omiyages.show', $omiyage->id) }}">{{ $omiyage->omiyage_name }}</a></span><br><br>
                            <span class="smoke-label"><a href="{{ route('ranking.rank', $omiyage->prefecture) }}"><i class="fas fa-map-marker-alt"></i>&nbsp;{{ $omiyage->prefecture }}</a></span>
                        </div>
                    </div>
                </div>    
            </div>
        </a>
    @endforeach
</div>