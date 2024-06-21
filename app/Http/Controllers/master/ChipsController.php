<?php

namespace App\Http\Controllers\master;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Chip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChipsController extends Controller
{
    function data(Request $request)
    {
        if (!empty($request->filters)) {
            foreach ($request->filters as $k => $v) {
                $chip = Chip::where($k, "LIKE", '%' . $v . '%')->paginate(10);
                return response()->json($chip);
            }
        }
        try {
            $chip = Chip::paginate(10);
            return response()->json($chip);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error']);
        }
    }

    function store(Request $request)
    {
        $messages = config('validate.validation');
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            // 'no_telepon' => 'max:25|numeric',
            // 'keterangan' => '',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $message = implode(' ', $errors);
            return response()->json(array_merge(ApiResponse::INVALID_REQUEST, ['messageValidator' => $message]));
        }

        $kode = $request->kode;
        $existingData = Chip::where('kode', $kode)->first();
        if ($existingData) {
            return response()->json(ApiResponse::ALREADY_EXIST);
        }
        try {
            $chip = Chip::create([
                'kode' => $kode,
                'no_telepon' => $request->no_telepon,
                'keterangan' => $request->keterangan,
            ]);
            // return response()->json(['status' => 'success']);
            return response()->json(ApiResponse::SUCCESS);
            // dd($chip);
        } catch (\Throwable $th) {
            dd($th);
            // return response()->json(['status' => 'error']);
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }

    function update(Request $request)
    {
        try {
            $messages = config('validate.validation');
            $validator = Validator::make($request->all(), [
                'kode' => 'required',
                // 'keterangan' => 'max:40|required'
            ], $messages);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $message = implode(' ', $errors);
                return response()->json(array_merge(ApiResponse::INVALID_REQUEST, ['messageValidator' => $message]));
            }
            $kode = $request->kode;
            $chip = Chip::where('kode', $kode)->update([
                'no_telepon' => $request->no_telepon,
                'keterangan' => $request->keterangan,
            ]);
            // return response()->json(['status' => 'success']);
            return response()->json(ApiResponse::SUCCESS);
        } catch (\Throwable $th) {
            // return response()->json(['status' => 'error']);
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }

    function delete(Request $request)
    {
        try {
            $kode = $request->kode;
            $chip = Chip::where('kode', $kode)->first();

            if (!$chip) {
                return response()->json(ApiResponse::NOT_FOUND);
            }

            $chip->delete();
            return response()->json(ApiResponse::SUCCESS);
        } catch (\Throwable $th) {
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }

}
