<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index', compact('categories'));
    }

    public function create(Request $request)
    {
        // Check if a category with the same slug already exists
        $isExist = Category::whereSlug(Str::slug($request->category))->first();

        if ($isExist) {
            flash()->error($request->category . ' adında bir kategori zaten var!');
            return redirect()->back();
        }

        // If category doesn't exist, create a new one
        $category = new Category;
        $category->name = $request->category;
        $category->slug = Str::slug($request->category);

        $category->save();
        flash()->success('Kategori başarıyla oluşturuldu.');
        return redirect()->back();
    }



    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);

    }


    public function switch(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == "true" ? 1 : 0;
        $category->save();
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete(); // Kalıcı olarak silme işlemi
            return redirect()->back()->with('success', 'Kategori kalıcı olarak silindi.');
        }

        return redirect()->back()->with('error', 'Kategori bulunamadı.');
    }

}
