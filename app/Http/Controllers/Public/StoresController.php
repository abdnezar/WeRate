<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UserRatingRequests;
use App\Http\Requests\UserRequests;
use App\Http\Requests\UserSearchRequest;
use App\Models\Genre;
use App\Models\Rate;
use App\Models\Store;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    public function index()
    {
        $stores = Store::with('genres')->with('rates')->orderby('id','desc')->paginate(25);
        $genres = Genre::all();
        $topRatedStores = Rate::with('stores')->with('stores.genres')->orderby('rate', 'desc')->limit(5)->paginate(5);
        return view('public.stores')->with('stores', $stores)->with('genres', $genres)->with('topRatedStores', $topRatedStores);
    }

    public function getStoreInfo($id)
    {
        $store = Store::with('genres')->where('id', $id)->first();
        $storeRates = Rate::where('stores_id',$id)->get();
        $rate = $this::getStoreRate($storeRates);
        return view('public.storeInfo')->with('store', $store)->with('storeRates', $storeRates)->with('rate',$rate);
    }

    public function addRate(UserRatingRequests $req,$storeId,$userMac)
    {
        $rating = $req['rating'];
        $rate = new Rate();
        $rate->rate = $rating;
        $rate->guest_mac = $userMac;
        $rate->stores_id = $storeId;
        $ratingState = $rate->save();
        session(['rateResult' => $ratingState]);
        return redirect()->back();
    }

    public function search(Request $req)
    {
        if ($req->query->has('searchText') && strlen($req['searchText']) > 2) {
            $storeName = $req['searchText'];
            $stores = Store::with('genres')->orderBy('name')->where('name', 'Like', $storeName . '%')->get();
            return view('public.search')->with('stores', $stores);
        } else {
            session(['searchResult' => 1]);
        }
        return view('public.search');
    }
}
