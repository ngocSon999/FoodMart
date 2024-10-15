<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $data = [
            'name' => $request->get('name'),
            'slug' => str_replace(' ', '-', strtolower($request->get('name'))),
        ];
        Category::create($data);

        return response()->json([
            'code' => 200
        ]);
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
