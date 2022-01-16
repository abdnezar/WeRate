@extends('layouts.sidebar')

@php
    $controller = new App\Http\Controllers\Public\StoresController();
    $mStores = $stores;
    $mTopRatedStores = $topRatedStores;
@endphp

@section('title')
    
    <div class="container">
        <div class="row" style="display: block;text-align: center">
            <div class="col-10">
                <a href="{{URL('search')}}" >
                    <div class="btn btn-light" style="color: #7386D5;"><i class="fa fa-search"></i> Search In Stores</div>
                </a>
                <a href="{{URL('stores')}}" >
                    <div class="btn"><h3 style="color: white;">WeRate</h3></div>
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="btn alert-primary col-1.5 m-1 genres" id="0" style="text-align: center;color:rgb(59, 55, 55);">All Genres</div>
            @foreach ($genres as $genre)
                <div class="btn alert-primary col-1.5 m-1 genres" id="{{$genre->id}}" style="text-align: center;color:rgb(59, 55, 55);">
                    {{$genre->genre}}
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('content')
    <div class="container mt-2">
        <div class="row d-flex justify-content-center">

            <h4 class="mt-3 col-12 topRatedStores"><mark>Top Rated Stores</mark></h4>
            <div class="topRatedStores" class="container mt-1" style="border-radius: 15px;margin-inline: 50px;padding: 2px;background: #7386D5">
                <div class="row">
                    <div id="carouselExampleIndicators" class="carousel slide jumpatron col-12" data-ride="carousel">
                        <div class="carousel-inner">

                            @foreach ($mTopRatedStores as $topStore)
                                @if ($loop->index == 0)
                                    <div class="carousel-item active">
                                        <a href="{{URL('store/info/'.$topStore->stores->id)}}">
                                            <img style="border-radius: 15px;" height="420px" width="800px" src="@if(!@empty($topStore->stores->logoUrl)){{env('STORAGE_URL').$topStore->stores->logoUrl}}@else{{asset('images/storeImg.jpg')}}@endif" >
                                            <div class="carousel-caption d-none d-md-block" style="background: #4861c7ab;border-radius:15px">
                                                <div>
                                                    @isset($topStore->stores->name)
                                                        <h5>{{$topStore->stores->name;}}</h5>
                                                    @endisset
                                                    <div class="row">
                                                        @isset($topStore->rate)
                                                        <p class="card-text col-6" style="text-align: center;color: orange"><i class="fa fa-star"></i> {{$topStore->rate;}}</p>
                                                        @endisset
                                                        @isset($topStore->stores->genres)
                                                            <p class="card-text col-6" style="text-align: center;color: orange"><i class="fa fa-code-branch"></i> {{$topStore->stores->genres->genre}}</p>
                                                        @endisset
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <a href="{{URL('store/info/'.$topStore->stores->id)}}">
                                            <img style="border-radius: 15px;" height="420px" width="800px" src="@if(!@empty($topStore->stores->logoUrl)){{env('STORAGE_URL').$topStore->stores->logoUrl}}@else{{asset('images/storeImg.jpg')}}@endif" >
                                            <div class="carousel-caption d-none d-md-block" style="background: #4861c7ab;border-radius:15px">
                                                <div>
                                                    @isset($topStore->stores->name)
                                                        <h5>{{$topStore->stores->name;}}</h5>
                                                    @endisset
                                                    <div class="row">
                                                        @isset($topStore->rate)
                                                        <p class="card-text col-6" style="text-align: center;color: orange"><i class="fa fa-star"></i> {{$topStore->rate;}}</p>
                                                        @endisset
                                                        @isset($topStore->stores->genres)
                                                            <p class="card-text col-6" style="text-align: center;color: orange"><i class="fa fa-code-branch"></i> {{$topStore->stores->genres->genre}}</p>
                                                        @endisset
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endForEach
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                        </ol>
                    </div>
                </div>
            </div>
            
            <h4 class="mt-3 col-12"><mark>All Stores</mark></h4>
            <small class="col-10">(Latest First)</small>
            @foreach ($mStores as $store)
                <div class="card col-2.5 m-2 p-1" aria-label="@if(!@empty($store->genres->id)){{$store->genres->id}}@else{{0}}@endif" style="border-radius: 15px" class="storeCards" id="storeCard{{$store->id}}" >
                    <a href="{{URL('store/info/'.$store->id)}}" aria-label="{{$store->id}}">
                        <img class="card-img-top" 
                        height="180"
                        style="max-width: 350px;border-radius: 15px;box-shadow: 2px 2px 2px rgba(73, 69, 69, 0.493);" 
                        src="@if(!@empty($store->logoUrl)){{env('STORAGE_URL').$store->logoUrl}}@else{{asset('images/storeImg.jpg')}}@endif"
                        alt="Image For {{$store->name}}">
                        <div class="card-img-overlay">
                            <p class="card-text"><i class="fa fa-star" style="color: orange"></i> {{$controller->getStoreRate($store->rates)}}</p>
                        </div>
                        <div class="card-img-bottom">
                            <h4>{{$store->name}}</h4>
                            <p class="card-text"><i class="fa fa-code-branch"></i> @if(!@empty($store->genres->genre)){{$store->genres->genre}}@else UnCategoriesed Store @endif</p>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>

    <div class="row d-flex justify-content-center">
        {{ $mStores->links() }}
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').hide();
            $('#sidebar').hide();
            $('#searchInput').keyup(function () {
                $('.card').show(100);
                var searchText = this.value;
                if (searchText.length >= 2) {
                    $('.card[aria-label!="'+ searchText +'"]').hide(100);
                }
            });

            $('div.genres:first').css("background-color", "lightgray").css("border","2px black solid");
            $('div.genres').click(function () {
                $('.card').show();
                $('div.genres').css("background-color", "").css("border","");

                $(this).css("background-color", "lightgray").css("border","2px black solid");
                if (this.id != 0) {
                    $('.topRatedStores').slideUp();
                    $('.card[aria-label!="'+ this.id +'"]').hide();
                } else {
                    $('.topRatedStores').slideDown();
                }
            });

        });
    </script>
@endsection