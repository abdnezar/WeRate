@extends('layouts.sidebar')

@section('title')
    <h3  style="color: white">Stores Management</h3>
@endsection

@section('content')

    <div class="container">
            <div class="row">
                <div class="col-1" ></div>
                    <div class="alert alert-info col-10  p-3 mt-3" style="border-radius: 15px">
                        <form id="storeForm" action="
                                @if (isset($_GET['id']))
                                    {{ URL('store/update/'. $_GET['id']) }}
                                @else
                                    {{ URL('store/store') }}
                                @endif" 
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                <h5><label style="color: black">Enter Store Name</label></h5>
                                <input name="storeName" type="text" class="form-control" maxlength="50" value="@if(isset($_GET['name'])){{$_GET['name'];}}@endif">
                            </div>
                            <div class="form-group">
                                <h5><label style="color: black">Enter Store Phone</label></h5>
                                <input name="storePhone" type="number" class="form-control" maxlength="20" value="@if(isset($_GET['phone'])){{$_GET['phone'];}}@endif">
                            </div>
                            <div class="form-group">
                                <h5><label style="color: black">Enter Store Latitude</label></h5>
                                <a href="https://www.google.com/maps/" target="_blank">
                                    <small><i class="fa fa-map"></i> Use Google Map</small>
                                </a>
                                <input name="storeLat" type="number" step="any" class="form-control" maxlength="25" value="@if(isset($_GET['lat'])){{$_GET['lat'];}}@endif">
                            </div>
                            <div class="form-group">
                                <h5><label style="color: black">Enter Store Longitude</label></h5>
                                <a href="https://www.google.com/maps/" target="_blank">
                                    <small><i class="fa fa-map"></i> Use Google Map</small>
                                </a>                                
                                <input name="storeLng" type="number" step="any" class="form-control" maxlength="25" value="@if(isset($_GET['lng'])){{$_GET['lng'];}}@endif">
                            </div>
                            <div class="form-group">
                                <h5><label style="color: black">Choose Store Genre 
                                    @if (isset($_GET['genreId']))
                                        <br>
                                        <h6><mark>Please ReChoose Genre</mark></h6>
                                    @endif
                                </label></h5>
                                <select class="form-control" name="storeGenreId" id="cat">
                                    <option value="-1" ></option>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id}}">{{$genre->genre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <h5><label style="color: black">Enter Store Logo 
                                    @if (isset($_GET['logoUrl']))
                                        <br>
                                        <h6><mark>Please Enter Logo</mark></h6>
                                    @endif
                                </label></h5>
                                <input name="storeLogo"  type="file" class="form-control">
                                <input name="storeOldLogo" value="@if(isset($_GET['logoUrl'])){{$_GET['logoUrl'];}}@endif" hidden>
                            </div>
                            <input type="submit" value="Save" class="btn btn-block btn-primary">
                        </form>
                    </div>
            </div>
        </div>
@endsection