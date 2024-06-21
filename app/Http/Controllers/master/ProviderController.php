<?php

namespace App\Http\Controllers\master;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    public function data(Request $request)
    {
        if (!empty($request->filters)) {
            foreach ($request->filters as $k => $v) {
                $providers = Providers::where($k, "LIKE", '%' . $v . '%')->paginate(10);
                return response()->json($providers);
            }
        }
        try {
            $providers = Providers::paginate(10);
            return response()->json($providers);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error']);
        }
    }

    public function store(Request $request)
    {
        $messages = config('validate.validation');
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $message = implode(' ', $errors);
            return response()->json(array_merge(ApiResponse::INVALID_REQUEST, ['messageValidator' => $message]));
        }

        $kode = $request->kode;
        $existingData = Providers::where('kode', $kode)->first();
        if ($existingData) {
            return response()->json(ApiResponse::ALREADY_EXIST);
        }
        try {
            $provider = Providers::create([
                'kode' => $kode,
                'nama' => $request->nama,
                'rate' => $request->rate,
                'min_transaksi' => $request->min_transaksi,
                'max_transaksi' => $request->max_transaksi,
                'biaya_admin' => $request->biaya_admin,
                'saldo_mengendap' => $request->saldo_mengendap,
                'image' => $request->image,
            ]);
            return response()->json(ApiResponse::SUCCESS);
        } catch (\Throwable $th) {
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }

    public function update(Request $request)
    {
        try {
            $messages = config('validate.validation');
            $validator = Validator::make($request->all(), [
                'kode' => 'required',
            ], $messages);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $message = implode(' ', $errors);
                return response()->json(array_merge(ApiResponse::INVALID_REQUEST, ['messageValidator' => $message]));
            }
            $kode = $request->kode;
            $provider = Providers::where('kode', $kode)->update([
                'nama' => $request->nama,
                'rate' => $request->rate,
                'min_transaksi' => $request->min_transaksi,
                'max_transaksi' => $request->max_transaksi,
                'biaya_admin' => $request->biaya_admin,
                'saldo_mengendap' => $request->saldo_mengendap,
                'image' => $request->image,
            ]);
            return response()->json(ApiResponse::SUCCESS);
        } catch (\Throwable $th) {
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }

    public function delete(Request $request)
    {
        try {
            $kode = $request->kode;
            $provider = Providers::where('kode', $kode)->first();

            if (!$provider) {
                return response()->json(ApiResponse::NOT_FOUND);
            }

            $provider->delete();
            return response()->json(ApiResponse::SUCCESS);
        } catch (\Throwable $th) {
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }
}
