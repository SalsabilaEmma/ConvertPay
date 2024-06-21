<?php

namespace App\Http\Controllers\master;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    public function data(Request $request)
    {
        if (!empty($request->filters)) {
            foreach ($request->filters as $k => $v) {
                $banks = Bank::where($k, "LIKE", '%' . $v . '%')->paginate(10);
                return response()->json($banks);
            }
        }
        try {
            $banks = Bank::paginate(10);
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
            'nama' => 'required',
            'kode_transfer' => 'required',
            'biaya_admin' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $message = implode(' ', $errors);
            return response()->json(array_merge(ApiResponse::INVALID_REQUEST, ['messageValidator' => $message]));
        }

        $kode = $request->kode;
        $existingData = Bank::where('kode', $kode)->first();
        if ($existingData) {
            return response()->json(ApiResponse::ALREADY_EXIST);
        }
        try {
            $bank = Bank::create([
                'kode' => $kode,
                'nama' => $request->nama,
                'kode_transfer' => $request->kode_transfer,
                'biaya_admin' => $request->biaya_admin,
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
                'nama' => 'required',
                'kode_transfer' => 'required',
                'biaya_admin' => 'required|numeric',
            ], $messages);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $message = implode(' ', $errors);
                return response()->json(array_merge(ApiResponse::INVALID_REQUEST, ['messageValidator' => $message]));
            }
            $kode = $request->kode;
            $bank = Bank::where('kode', $kode)->update([
                'nama' => $request->nama,
                'kode_transfer' => $request->kode_transfer,
                'biaya_admin' => $request->biaya_admin,
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
            $bank = Bank::where('kode', $kode)->first();

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
