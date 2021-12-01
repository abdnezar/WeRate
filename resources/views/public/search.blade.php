@extends('layouts.sidebar')

@section('title')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{URL('stores')}}" >
                    <div class="btn"><h3 style="color: white;"> WeRate</h3></div>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8 alert-info p-2 mt-3" style="border-radius: 5px">
                <form class="updateForm row d-flix justify-content-center" action="{{URL('search')}}" method="get" >
                    <input  type="text" minlength="3" name="searchText" class="form-control col-8 mr-1" value="@if (isset($_GET['searchText'])){{$_GET['searchText']}}@endif" maxlength="50" placeholder="Enter Store Name">
                    <button type="submit" class="btn btn-primary col-2"><i class="fa fa-search"></i> Search </button>
                </form>
            </div>
        </div>
    </div>
    
    @if (isset($stores))
    <div class="container mt-2">
        <div class="row d-flex justify-content-center">
            @php
                $mStores = $stores;
             @endphp

            <h3 class="mt-3 col-12"><mark>Matches Stores</mark></h3>
            @foreach ($mStores as $store)
            <div class="card col-2.5 m-2 p-1" style="max-width: 280px" aria-label="@if(!@empty($store->genres->id)){{$store->genres->id}}@else{{0}}@endif" style="border-radius: 15px" class="storeCards" id="storeCard{{$store->id}}" >
                <a href="{{URL('store/info/'.$store->id)}}" aria-label="{{$store->id}}">
                    <img class="card-img-top" 
                    height="150"
                    style="border-radius: 15px;box-shadow: 2px 2px 2px rgba(73, 69, 69, 0.493);" 
                    src="@if(!@empty($store->logoUrl)){{env('STORAGE_URL').$store->logoUrl}}@else{{asset('images/storeImg.jpg')}}@endif"
                    alt="Image For {{$store->name}}">
                    <div class="card-img-bottom">
                        <h4>{{$store->name}}</h4>
                        <p class="card-text"><i class="fa fa-phone"></i> {{$store->phone}}</p>
                        <p class="card-text"><i class="fa fa-code-branch"></i> @if(!@empty($store->genres->genre)){{$store->genres->genre}}@else UnHandled Store @endif</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif


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

        });
    </script>
@endsection