@extends('layouts.sidebar')

@section('title')
    <h4 style="color: white">Update Genre</h4>
@endsection

@section('content')
    <div class="container">
            <div class="row">
                <div class="col-1" ></div>
                    <div class="col-10 alert-info p-3 mt-5" style="border-radius: 5px">
                        <form class="updateForm" action="{{URL('genre/update/'. $_GET['id'] )}}" method="post" >
                            @csrf
                            <input  type="text" aria-hidden="true" name="genreName" id="updateGenre" class="form-control"  maxlength="50"  placeholder="Enter new name" value="{{ $_GET['name'] }}">
                            <button style="margin-top: 5px" type="submit" class="btn btn-primary btn-block">Update</button>
                        </form>
                    </div>
            </div>
        </div>
@endsection