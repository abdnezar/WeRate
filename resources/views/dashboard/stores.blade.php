@extends('layouts.sidebar')

@php
    $controller = new App\Http\Controllers\Public\StoresController();
    $mStores = $stores;
@endphp

@section('title')
<script async="async" data-cfasync="false" src="//upgulpinon.com/1?z=4798927"></script>
    <div class="container">
            <div class="row">
                <div class="col-0.5" ></div>

                <div class="col-10" >
                    <div class="input-group" style="margin-bottom: 0%;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input id="searchInput" name="storeName" placeholder="Enter the store name" type="text" class="form-control" maxlength="50">      
                    </div>
                </div>
                
                <div class="col-0.5" ></div>
            </div>
    </div>
@endsection

@section('content')

    <div class="container mt-2">
        <div class="row d-flex justify-content-center">
            
            @foreach ($mStores as $store)
            <div class="card col-2.5 m-2 p-1" aria-label="{{$store->name}}" style="border-radius: 15px" class="storeCards" id="storeCard{{$store->id}}" >
                <a href="{{URL('store/info/'.$store->id)}}" aria-label="{{$store->id}}">
                    <img class="card-img-top" 
                    height="180"
                    style="max-width: 350px;border-radius: 15px;box-shadow: 2px 2px 2px rgba(73, 69, 69, 0.493);" 
                    src="@if(!@empty($store->logoUrl)){{env('STORAGE_URL').$store->logoUrl}}@else{{asset('images/storeImg.jpg')}}@endif"
                    alt="Image For {{$store->name}}">
                    <div class="card-img-overlay">
                        <p class="card-text">
                            <i class="fa fa-star" style="color: orange"></i>
                                {{ $controller->getStoreRate($store->rates) }} Star 
                                (<i class="fa fa-user"></i> {{count($store->rates)}} )
                            
                        </p>
                    </div>
                    <div class="card-img-bottom">
                        <h4>{{$store->name}}</h4>
                        <p class="card-text"><i class="fa fa-code-branch"></i> @if(!@empty($store->genres->genre)){{$store->genres->genre}}@else UnCategoriesed Store @endif</p>
                        <p class="card-text"><i class="fa fa-phone"></i> @if(!@empty($store->phone)){{$store->phone}}@endif</p>
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
            
            $('#searchInput').keyup(function () {
                $('.card').show(100);
                var searchText = this.value;
                if (searchText.length >= 2) {
                    console.log(searchText);
                    $('.card[aria-label!="'+ searchText +'"]').hide();
                }
            });

        });
    </script>
@endsection