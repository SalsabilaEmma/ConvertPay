<?php

namespace App\Http\Controllers\logs;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\TransactionLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiLogController extends Controller
{
    public function store(Request $request)
    {
        $messages = config('validate.validation');
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            // 'provider_kode' => 'required|exists:providers,id',
            // 'no_telepon' => 'required|string|max:15',
            // 'tgl_transaksi' => 'required|date',
            // 'nominal_pulsa' => 'required|numeric|min:0',
            // 'nilai_konversi' => 'required|numeric|min:0',
            // 'status' => 'required|in:0,1,2',
            // 'deskripsi' => 'nullable|string',
            // 'balance_before' => 'required|numeric|min:0',
            // 'balance_after' => 'required|numeric|min:0',
            // 'metode_pembayaran' => 'required|string',
            // 'no_rekening' => 'required|string',
            // 'atas_nama' => 'required|string',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $message = implode(' ', $errors);
            return response()->json(array_merge(ApiResponse::INVALID_REQUEST, ['messageValidator' => $message]));
        }

        try {
            $transactionLog = TransactionLogs::create([
                'user_id' => $request['user_id'],
                'provider_kode' => $request['provider_kode'],
                'no_telepon' => $request['no_telepon'],
                'tgl_transaksi' => $request['tgl_transaksi'],
                'nominal_pulsa' => $request['nominal_pulsa'],
                'nilai_konversi' => $request['nilai_konversi'],
                'status' => $request['status'],
                'deskripsi' => $request['deskripsi'],
                'balance_before' => $request['balance_before'],
                'balance_after' => $request['balance_after'],
                'metode_pembayaran' => $request['metode_pembayaran'],
                'no_rekening' => $request['no_rekening'],
                'atas_nama' => $request['atas_nama'],
            ]);
            return response()->json(ApiResponse::SUCCESS);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }
}
