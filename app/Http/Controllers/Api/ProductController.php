<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Category::all()->toArray(),
            'code' => 200
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = [
                'trademark_id' => $request->get('trademark_id'),
                'name' => $request->get('name'),
                'slug' => str_replace(' ', '-', strtolower($request->get('name'))),
                'description' => $request->get('description'),
                'quantity' => $request->get('quantity'),
                'price' => $request->get('price'),
            ];
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = $file->getClientOriginalName();
                $filePath  = $file->StoreAs('uploads/products', $fileName, 'public');
                $url = asset('storage/' . $filePath);
                $data['image'] = $url;
            }
            $product = Product::create($data);
            DB::commit();

            return response()->json([
                'data' => $product,
                'code' => 200
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'msg' => $exception->getMessage(),
                'code' => 500
            ]);
        }
    }

    public function update($id, Request $request): JsonResponse
    {
        $category = Category::find($id);
        $data = [
            'name' => $request->get('name'),
            'slug' => str_replace(' ', '-', strtolower($request->get('name'))),
        ];
        $category->update($data);

        return response()->json([
            'data' => $id,
            'code' => 200
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json('deleted category!', 204);
    }

    public function renderPdf()
    {
        $data = [
            'user' => [
                'name' => 'John Doe',
                'age' => 20,
                'address' => '123 Street'
            ],
            'role' => [
                'name' => 'Admin',
                'slug' => 'admin'
            ]
        ];
        $customPaper = array(0,0,794,1123);
        $pdf = Pdf
            ::loadView('pdf.test', compact('data'))
            ->setPaper($customPaper);
        return $pdf->download('test-download.pdf');
    }
}
