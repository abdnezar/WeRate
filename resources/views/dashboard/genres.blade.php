@extends('layouts.sidebar')
@php
    $mGenres = $genres
@endphp

@section('title')
    <h3 style="color: white">Stores Genres</h3>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-1" ></div>
        <div class="col-10 alert alert-info p-3 mt-3" style="border-radius: 5px">
            <form id="storeForm" action="{{ URL('genre/store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <h5><label for="genreName" style="color: white">Enter Genre Name</label></h5>
                    <input name="genreName" type="text" class="form-control" placeholder="max 50 character" id="genreName" aria-describedby="emailHelp" maxlength="50">
                </div>
                <input type="submit" class="btn btn-block btn-primary">
            </form>
        </div>
        <table class="table table-hover table-hover" style="margin-top: 5px;text-align: center">
            <thead class="thead-dark">
                <th class="th">Name</th>
                <th>  </th>
                <th>  </th>
                <th class="th">Edit</th>
                <th class="th">Delete</th>
            </thead>
                
            <tbody>
                <br><br>
                @foreach ($mGenres as $genre)
                    <tr>
                        <td><h5><b>{{ $genre->genre }}</b></h5>  </td>
                        <td></td>
                        <td></td>
                        <td><button id="btnEdit" class="btn btn-info"><a href="{{ URL('genre/update?id='. $genre->id . '&name=' . $genre->genre )}}"><i class="fa fa-edit"></i> Edit </button></td>
                        
                        @if (empty($genre->deleted_at))
                            <form action="{{URL('genre/delete/'. $genre->id) }}" method="post">
                                @csrf
                                <td><button class="btnDelete btn btn-danger"><i class="fa fa-trash"></i> Delete</button></td>
                            </form>
                        @else
                            <form action="{{URL('genre/restore/'. $genre->id)}}" method="post">
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
@endsection