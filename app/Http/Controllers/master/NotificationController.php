<?php

namespace App\Http\Controllers\master;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function data(Request $request)
    {
        if (!empty($request->filters)) {
            foreach ($request->filters as $k => $v) {
                $notifs = Notification::where($k, "LIKE", '%' . $v . '%')->paginate(10);
                return response()->json($notifs);
            }
        }
        try {
            $notifs = Notification::paginate(10);
            return response()->json($notifs);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error']);
        }
    }

    public function store(Request $request)
    {
        $messages = config('validate.validation');
        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'judul' => 'required',
            // 'link' => 'required',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $message = implode(' ', $errors);
            return response()->json(array_merge(ApiResponse::INVALID_REQUEST, ['messageValidator' => $message]));
        }

        $kode = $request->kode;
        $existingData = Notification::where('kode', $kode)->first();
        if ($existingData) {
            return response()->json(ApiResponse::ALREADY_EXIST);
        }
        try {
            $notif = Notification::create([
                'kode' => $kode,
                'judul' => $request->judul,
                'link' => $request->link,
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
                'judul' => 'required',
                // 'link' => 'required',
            ], $messages);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $message = implode(' ', $errors);
                return response()->json(array_merge(ApiResponse::INVALID_REQUEST, ['messageValidator' => $message]));
            }
            $kode = $request->kode;
            $notif = Notification::where('kode', $kode)->update([
                'judul' => $request->judul,
                'link' => $request->link,
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
            $notif = Notification::where('kode', $kode)->first();

            if (!$notif) {
                return response()->json(ApiResponse::NOT_FOUND);
            }

            $notif->delete();
            return response()->json(ApiResponse::SUCCESS);
        } catch (\Throwable $th) {
            return response()->json(ApiResponse::PROCESSING_ERROR);
        }
    }
}
