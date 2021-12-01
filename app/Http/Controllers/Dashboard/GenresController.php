<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public static function create() {
        $genres = Genre::withTrashed()->orderBy('deleted_at')->get();
        return view('dashboard.genres')->with('genres', $genres);
    }

    public function store(GenreRequest $request) {
        $genreName = $request['genreName'];

        $genre = new Genre();
        $genre->genre = $genreName;
        $insertResult = $genre->save();

        session(['insertResult' => $insertResult]);
        return redirect('genre/create');
    }

    public function update(GenreRequest $request, $id){
        $newName = $request['genreName'];
        $updateResult = Genre::where('id', $id)->update(['genre'=>$newName]);

        session(['updateResult' => $updateResult]);
        return redirect('genre/create');
    }

    public function drop($id) {
        $deleteResult = Genre::where('id',$id)->delete();
        session(['deleteResult' => $deleteResult]);
        return redirect('genre/create');
    }

    public function restore($id) {
        $restoreResult = Genre::where('id', $id)->restore();

        session(['restoreResult' => $restoreResult]);
        return redirect('genre/create');
    }

    public function getUpdateView(){
        return view('dashboard.updateGenre');
    }

}
