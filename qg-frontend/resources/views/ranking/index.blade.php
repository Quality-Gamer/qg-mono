@extends('layout.app')

@section('content')

<div class="col-lg-8 col-md-12 col-sm-12 col-12">
    <div id="messages">
        
    </div>
    <div align="center"><h1 class="title-page">Top 5</h1></div>
    <div class="jumbotron p-4 card-default col-lg-12 col-md-12 col-sm-12 bg-lg-green scrolling">
    @if(!$empty)
    @foreach ($rank as $value)
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 alert">
            <div class="row ranking-wrap">
                <!-- <div class="col-lg-3 col-md-3 col-sm-3 text-blue ranking-text"><strong>{{$value->Rank}}.</strong></div> -->
                <div class="col-lg-4 col-md-4 col-sm-4 text-blue ranking-text"><img class="navbar-img" src="../assets/img/icons/rank_{{$value->Rank}}.png"> </div>
                <div class="col-lg-4 col-md-4 col-sm-4 text-blue ranking-text"><strong>{{$users[$value->Name]}}</strong></div>
                <div class="col-lg-4 col-md-4 col-sm-4 text-blue ranking-text"><strong>{{$value->Score}}pts</strong></div>
            </div>
            <div class="col-3"></div>
            </div>
        </div>
    @endforeach
    @else
        <div align="center">
            <strong><div class="col-lg-6 col-md-6 col-sm-6 text-blue ranking-text mt-5"> Por enquanto o ranking está vazio. Volte mais tarde!</div><strong>
            <br/>
            <img src="../assets/img/icons/empty.png">
        </div>
    @endif
    </div>
</div>

@endsection

@section('scripts')
<script>
    
</script>
@endsection