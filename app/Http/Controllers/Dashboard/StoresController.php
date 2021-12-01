<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Genre;
use App\Models\Store;

class StoresController extends Controller {

    public function index() {
        $stores = Store::paginate(20);
        return view('dashboard/stores')->with('stores', $stores);
    }

    public static function create()
    {
        $genres = Genre::orderBy('deleted_at')->get();
        return view('dashboard.createStore')->with('genres',$genres);
    }

    public function store(StoreRequest $request)
    {
        $storeName = $request['storeName'];
        $storePhone = $request['storePhone'];
        $storeLat = $request['storeLat'];
        $storeLng = $request['storeLng'];
        $storeGenreId = $request['storeGenreId'];

        $fileName = Controller::uploadFile($request, 'storeLogo');
        if ($fileName == null) {
            return redirect()->back();
        }

        $store = new Store();
        $store->name = $storeName;
        $store->phone = $storePhone;
        $store->lat = $storeLat;
        $store->lng = $storeLng;
        $store->genres_id = $storeGenreId;
        $store->logoUrl = $fileName;
        $insertResult = $store->save();

        session(['insertResult' => $insertResult]);
        return redirect('store/manage');
    }

    public function update(StoreRequest $request, $id)
    {
        $storeName = $request['storeName'];
        $storePhone = $request['storePhone'];
        $storeLat = $request['storeLat'];
        $storeLng = $request['storeLng'];
        $storeGenreId = $request['storeGenreId'];

        $fileName = Controller::uploadFile($request, 'storeLogo',true);
        
        $updateResult = Store::where('id', $id)->update([
            'name' => $storeName,
            'phone' => $storePhone,
            'lat' => $storeLat,
            'lng' => $storeLng,
            'genres_id' => $storeGenreId,
            'logoUrl' => $fileName,
        ]);

        session(['updateResult' => $updateResult]);        
        return redirect('store/manage');
    }

    public function getManageView()
    {
        $stores = Store::withTrashed()->orderBy('id','desc')->with('rates')->with('genres')->paginate(15);
        return view('dashboard.manageStores')->with('stores',$stores);
    }

    public function drop($id)
    {
        $deleteResult = Store::where('id', $id)->delete();
        session(['deleteResult' => $deleteResult]);
        return redirect('store/manage');
    }

    public function restore($id)
    {
        $restoreResult = Store::where('id', $id)->restore();
        session(['restoreResult' => $restoreResult]);
        return redirect('store/manage');
    }

}
