@extends('layouts.sidebar')

@php
    $controller = new App\Http\Controllers\Public\StoresController();
    $mStores = $stores;
@endphp

@section('title')
    <h4 style="color: white">Manage Stores</h4>
@endsection

@section('content')

    <div class="container">
        <div class="row d-flex justify-content-center ml-4">
        <div class="col-1" ></div>
        <table class="table table-striped table-hover" style="margin-top: 5px;text-align: center;">
            <thead class="thead-dark">
                <th><i class="fa fa-id-card"></i> ID</th>
                <th><i class="fa fa-link"></i> Logo Url</th>
                <th><i class="fa fa-user-circle"></i> Name</th>
                <th><i class="fa fa-star"></i> Rate</th>
                <th><i class="fa fa-phone"></i> Phone</th>
                <th><i class="fa fa-map-marker-alt"></i> Location<br>Lat-Lng</th>
                <th><i class="fa fa-code-branch"></i> Genre</th>
                <th><i class="fa fa-edit"></i> Edit</th>
                <th><i class="fa fa-trash"></i> Delete</th>
            </thead>

            <tbody>
                <br><br>
                                
                @foreach($mStores as $store)
                    <tr>
                        <td><b>{{ $store->id }}</b></td>
                        <td><img class="bg-primary" style="border: 2px black solid;max-width: 160px;border-radius: 15px;" height="150px" src="{{env('STORAGE_URL').$store->logoUrl}}" alt="image for {{$store->name}} Store"></td>
                        <td><b>{{ $store->name }}</b></td>
                        <td><b>@if(isset($store->rates)){{ $controller::getStoreRate($store->rates) }}@endif</b></td>
                        <td><b>{{ $store->phone }}</b></td>
                        <td><b>{{ $store->lat}}<br>{{$store->lng }}</b></td>
                        <td><b>@if(!empty($store->genres->genre)){{ $store->genres->genre }}@endif</b></td>

                        <td><a href="{{ URL('store/create?id='. $store->id . '&name=' .$store->name  . '&phone=' .$store->phone . '&lat=' .$store->lat . '&lng=' .$store->lng . '&genreId=' .$store->genres_id . '&logoUrl=' .$store->logoUrl) }}">
                            <button id="btnEdit" class="btn btn-info"> Edit </button>
                            </a>
                        </td>
                        
                        @if (empty($store->deleted_at))
                            <form action="{{URL('store/delete/'. $store->id) }}" method="post">
                                @csrf
                                <td><button class="btnDelete btn btn-danger">Delete</button></td>
                            </form>
                        @else
                            <form action="{{URL('store/restore/'. $store->id)}}" method="post">
                                @csrf
                                <td><button class="btn btn-success"><i class="fa fa-edit"></i> Restore</button></td>
                            </form>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        {{ $mStores->links() }}
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $("img").on({
                mouseenter: function(){
                    $(this).css("height","200px").css( "max-width","200px");
                },
                mouseleave: function(){
                    $(this).css("height","140px").css( "max-width","160px");
                }
            });

            $('td').css("text-align","center").css( "vertical-align","middle");
        });
     </script>
@endsection