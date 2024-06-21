<?php

namespace App\Http\Controllers\master;

use App\Helpers\ApiResponse;
use App\Helpers\GetterSetter;
use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public static function getAllDBConfig()
    {
        try {
            $configs = Config::all()->pluck('keterangan', 'kode');
            return response()->json(['status' => 'success', 'data' => $configs]);
        } catch (\Throwable $th) {
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }

    public function getDBConfig(Request $request)
    {
        $KEY = $request->KEY;
        $response = GetterSetter::getDBConfig($KEY);
        return response()->json($response);
    }

    public function setDBConfig(Request $request)
    {
        try {
            $configData = $request->all(); // Mendapatkan seluruh data dari body request
            foreach ($configData as $key => $value) {
                GetterSetter::setDBConfig($key, $value); // Memanggil fungsi setDBConfig untuk setiap pasangan kunci-nilai
            }
            return response()->json(ApiResponse::SUCCESS);
        } catch (\Throwable $th) {
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }

}
