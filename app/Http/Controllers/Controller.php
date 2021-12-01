<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function uploadFile($request,$fileInputName,$oldFilePath = null) {
        $path = "/uploads/images/";
        
        if ($request->hasFile($fileInputName) && self::checkIsImage($request, $fileInputName)) {
            $logoSize = $request->file($fileInputName)->getSize(); //maximum 2 mega
            if ($logoSize < 3_000_000) {
                $storeLogo = $request->file($fileInputName);

                $name = time() + rand(10000, 1000000) . $storeLogo->getClientOriginalName() . '.' . $storeLogo->getClientOriginalExtension();
                Storage::disk('local')->put($path . $name, file_get_contents($storeLogo));
                if (isset($needDeleteOldFile)) {
                    Storage::disk('local')->delete($oldFilePath);
                }
            } else {
                session(['insertResult' => 3]);
                return;
            }
        } else {
            session(['insertResult' => 2]);
            return;
        }

        return $path.$name;
    }

    public static function checkIsImage($request, $fileInputName)
    {
        $storeLogo = $request->file($fileInputName);
        $logoExt = $storeLogo->getClientOriginalExtension();
        if ($logoExt == "jpg" || $logoExt == "png" || $logoExt == "jpeg" || $logoExt == "gif") {
            return true;
        }
        return false;
    }

    public static function getStoreRate($storeRates)
    {
        $rate = 0;
        $rateSum = 0;
        $rateCount = 0;
        foreach ($storeRates as $store) {
            $rateSum += $store->rate;
            $rateCount++;
        }
        if ($rateSum > 0) {
            $rate = $rateSum / $rateCount;
        }
        // dd($rateSum, $rateCount, $rate);
        return $rate;
    }
}
