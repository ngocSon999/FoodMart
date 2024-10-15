<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function uploadFile(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $files = $request->file('file');
                foreach ($files as $file) {
                    $fileName = $file->getClientOriginalName();
                    $file->storeAs('uploads', $fileName, 'public');
                }

                return response()->json([
                    'msg' => 'File successfully uploaded',
                    'code' => 200
                ]);
            }

            return response()->json([
                'msg' => 'file not uploaded',
                'code' => 500
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'msg' => $exception->getMessage(),
                'code' => 500
            ]);
        }
    }
}
