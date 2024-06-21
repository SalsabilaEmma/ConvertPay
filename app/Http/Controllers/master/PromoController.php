<?php

namespace App\Http\Controllers\master;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
{
    public function data(Request $request)
    {
        if (!empty($request->filters)) {
            foreach ($request->filters as $k => $v) {
                $banks = Promo::where($k, "LIKE", '%' . $v . '%')->paginate(10);
                return response()->json($banks);
            }
        }
        try {
            $banks = Promo::paginate(10);
            return response()->json($banks);
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
        $existingData = Promo::where('kode', $kode)->first();
        if ($existingData) {
            return response()->json(ApiResponse::ALREADY_EXIST);
        }
        try {
            $bank = Promo::create([
                'kode' => $kode,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'image' => $request->image,
                'status' => $request->status,
            ]);
            return response()->json(ApiResponse::SUCCESS);
        } catch (\Throwable $th) {
            dd($th);
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
            $bank = Promo::where('kode', $kode)->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'image' => $request->image,
                'status' => $request->status,
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
            $bank = Promo::where('kode', $kode)->first();

            if (!$bank) {
                return response()->json(ApiResponse::NOT_FOUND);
            }

            $bank->delete();
            return response()->json(ApiResponse::SUCCESS);
        } catch (\Throwable $th) {
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }
}
