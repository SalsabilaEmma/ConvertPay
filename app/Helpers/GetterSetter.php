<?php

namespace App\Helpers;

use App\Models\Config;
use App\Models\NomorFaktur;

class GetterSetter
{
    public static function getLastKodeFunc($key, $len)
    {
        $valueReturn = '';
        $nomor = 0;
        try {
            $query = NomorFaktur::where('kode', str_replace(' ', '', $key))
                ->first();

            if ($query) {
                $nomor = $query->nomor;
                $nomor++;
            } else {
                $value = str_replace(' ', '', $key);
                NomorFaktur::create(['kode' => $value]);
                $query = NomorFaktur::where('kode', $value)->first();

                if ($query) {
                    $nomor = $query->nomor;
                    $nomor++;
                }
            }

            $valueReturn = (string) $nomor;
            $valueReturn = str_pad($valueReturn, $len, '0', STR_PAD_LEFT);
        } catch (\Exception $ex) {
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }

        return $valueReturn;
    }
    // UNTUK MENDAPATKAN GENERATE FAKTUR
    public static function getLastKode($key, $len)
    {
        try {
            $instance = new self();
            $valueReturn = "";
            $tgl = date("ymd"); // Mengambil tanggal saat ini dalam format YYMMDD
            $valueReturn = $instance->getLastKodeFunc($key, $len);
            // dd('valueReturn',$valueReturn);
            // $key = str_replace(" ", "", $key) . $tgl;
            $key = str_replace(" ", "", $key);
            $nomor_urut = (int)$valueReturn; // Mengonversi nomor urut menjadi integer
            // Menggunakan sprintf untuk memastikan nomor urut memiliki panjang 9 karakter, diisi dengan angka 0 jika kurang dari itu
            $nomor_faktur = $key . sprintf("%04d", $nomor_urut);
            // dd($valueReturn);
            return $nomor_faktur;
        } catch (\Throwable $th) {
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }
    // UNTUK MENYIMPAN GENERATE FAKTUR
    public static function setLastKode($key)
    {
        try {
            $result = NomorFaktur::where('kode', $key)->first();
            // dd($result);
            if ($result) {
                $id = $result->nomor;
                $id++;
                $result->nomor = $id;
                $result->save();
            } else {
                $id = 1;
                $result = NomorFaktur::create([
                    'kode' => $key,
                    'nomor' => $id
                ]);
            }
        } catch (\Exception $ex) {
            // dd($ex);
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
        return response()->json(ApiResponse::SUCCESS);
    }
    public static function getDBConfig($KEY)
    {
        try {
            $result = '';
            $query = Config::where('kode', $KEY)->first();
            if ($query) {
                $result = $query->keterangan;
            }
            return $result;
        } catch (\Throwable $th) {
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
        return response()->json(ApiResponse::SUCCESS);
    }

    public static function setDBConfig($KEY, $VALUE)
    {
        try {
            $result = Config::where('kode', $KEY)->first();
            if (!$result) {
                Config::insert(['kode' => $KEY]);
            }
            $where = ['kode' => $KEY];
            $data = ['keterangan' => $VALUE];
            Config::where($where)->update($data);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
        return response()->json(ApiResponse::SUCCESS);
    }
}
