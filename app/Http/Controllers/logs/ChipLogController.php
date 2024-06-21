<?php

namespace App\Http\Controllers\logs;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\ChipLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChipLogController extends Controller
{
    public function store(Request $request)
    {
        $messages = config('validate.validation');
        $validator = Validator::make($request->all(), [
            // 'user_id' => 'required',
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
            $transactionLog = ChipLog::create([
                'kode' => $request['kode'],
                'chip_kode' => $request['chip_kode'],
                'saldo_awal' => $request['saldo_awal'],
                'total' => $request['total'],
                'saldo_real' => $request['saldo_real'],
                'selisih' => $request['selisih'],
                'keterangan' => $request['keterangan'],
            ]);
            return response()->json(ApiResponse::SUCCESS);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }
}
