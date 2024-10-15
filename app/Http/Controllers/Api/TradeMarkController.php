<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TradeMark;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TradeMarkController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => TradeMark::all()->toArray(),
            'code' => 200
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->get('name'),
                'slug' => str_replace(' ', '-', strtolower($request->get('name'))),
            ];
            if (!empty($request->get('parent_id'))) {
                $data['parent_id'] = $request->get('parent_id');
            }
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $filePath  = $file->StoreAs('uploads/tradeMarks', $fileName, 'public');
                $url = asset('storage/' . $filePath);
                $data['image'] = $url;
            }
            TradeMark::create($data);
            DB::commit();

            return response()->json([
                'code' => 200
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'message' => $exception->getMessage(),
                'code' => 500
            ]);
        }
    }

    public function update($id, Request $request): JsonResponse
    {
        $trademark = TradeMark::find($id);
        $data = [
            'name' => $request->get('name'),
            'slug' => str_replace(' ', '-', strtolower($request->get('name'))),
        ];
        if ($request->$request->get('parent_id')) {
            $data['parent_id'] = $request->get('parent_id');
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->StoreAs('uploads/tradeMarks', $fileName, 'public');

            $url = Storage::url($fileName);
            $data['image'] = $url;
        }
        $trademark->update($data);

        return response()->json([
            'data' => $id,
            'code' => 200
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $trademark = TradeMark::findOrFail($id);
        $trademark->delete();

        return response()->json('deleted trademark!', 204);
    }
}
