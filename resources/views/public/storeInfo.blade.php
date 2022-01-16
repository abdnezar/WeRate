@extends('layouts.sidebar')
@php
    // get user mac address
    $userMac = exec('getmac');
    $userMac = strtok($userMac, ' ');

    $mStoreRates = $storeRates;
    $isNewRate = true;
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
@endsection

@section('content')
    <script>
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
        
        let map;
        function initMap() {
            // The location of Uluru
            const uluru = {
                lat: {{$store->lat;}},
                lng: {{$store->lng;}}
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
    </script>

    <style>
        .checked {
           color: orange;
        }
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center
        }

        .rating>input {
            display: none
        }

        .rating>label {
            position: relative;
            width: 60px;
            font-size: 6vw;
            color: #FFD600;
            cursor: pointer
        }

        .rating>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0
        }

        .rating>label:hover:before,
        .rating>label:hover~label:before {
            opacity: 1 !important
        }

        .rating>input:checked~label:before {
            opacity: 1
        }

        .rating:hover>input:checked~label:before {
            opacity: 0.4
        }
    </style>

    <style>
    /* Tooltip container */
        .tooltip {
            position: relative;
            display: inline-block;
            border-bottom: 1px dotted black;
            /* If you want dots under the hoverable text */
        }

        /* Tooltip text */
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: #555;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;

            /* Position the tooltip text */
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -60px;

            /* Fade in tooltip */
            opacity: 0;
            transition: opacity 0.3s;
        }

        /* Tooltip arrow */
        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>

    <div class="container">
        <div class="row m-3 d-flex justify-items-center">
            <div class="col-6">
                <div id="map" style="height: 500px;border-radius: 15px"></div>
                <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYdsxqhybexFNmx37-6cPlv53qjXuvSqI&callback=initMap"></script>
            </div>
            <div class="col-6">
                <div class="card alert-info p-1" style="border-radius: 15px">
                    <img class="card-img-top " style="max-width: 650px;border-radius: 15px" src="{{env('STORAGE_URL').$store->logoUrl}}" alt="Card image">
                    <div class="card-img-bottom p-1">
                        <h4 class="card-title col-12" style="text-align: center">{{$store->name}} 
                            @if ($trend) <i title="Rating is UP compared to the previous week" class="fas fa-arrow-alt-circle-up"></i>
                            @else <i title="Rating is DOWN compared to the previous week" class="far fa-arrow-alt-circle-down"></i>
                            @endif
                        </h4>
                    </div>
                    <div class="row">
                        <p class="card-text col-4" style="text-align: center">@if(!@empty($store->genres)) <i class="fa fa-code-branch"></i> {{$store->genres->genre}}@endif</p>
                        <p class="card-text col-4" style="text-align: center">@if(!@empty($rate)) <i class="fa fa-star"></i> {{$rate}} Stars<br>({{count($storeRates)}} Vote) @endif</p>
                        <p class="card-text col-4" style="text-align: center">@if(!@empty($store->phone)) <i class="fa fa-phone"></i> {{$store->phone}}@endif</p>
                    </div>

                    <div class="row d-flex justify-content-center">
                        @foreach ($mStoreRates as $storeRate)
                            @if ($storeRate->guest_mac == $userMac)
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($storeRate->rate <= $i)
                                        <span class="fa fa-star"></span>
                                    @else
                                        <span class="fa fa-star checked"></span>
                                    @endif
                                @endfor
                                {{$isNewRate = false;}}
                                <br>
                                <small class="col-12" style="text-align: center">Your Rate At {{$store->created_at}}</small>
                                @break
                            @endif
                        @endforeach
                    </div>
                    
                    @if ($isNewRate)
                        <div class="container">
                            <div class="row">
                                <div class="col-12 m-1">
                                    <form action="{{url('store/addRate/'.$store->id.'/'.$userMac)}}" method="post">
                                        @csrf
                                        <div class="rating">
                                            <input type="submit" name="rating" value="5" id="5">
                                            <label for="5">☆</label>
                                            <input type="submit" name="rating" value="4" id="4">
                                            <label for="4">☆</label>
                                            <input type="submit" name="rating" value="3" id="3">
                                            <label for="3">☆</label>
                                            <input type="submit" name="rating" value="2" id="2">
                                            <label for="2">☆</label>
                                            <input type="submit" name="rating" value="1" id="1">
                                            <label for="1">☆</label>
                                        </div>
                                    </form>
                                </div>
                                <small class="col-12" style="text-align: center">Add Your Rate Once</small>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection