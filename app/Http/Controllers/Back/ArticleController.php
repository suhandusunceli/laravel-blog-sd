<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'ASC')->get();
        return view('back.articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.articles.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $article = new Article();
        $article->title = $request->input('title');
        $article->category_id = $request->input('category');
        $article->content = $request->input('content');
        $article->slug = Str::slug($request->input('title'));

        // Handle file upload
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('title')) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $article->image = 'uploads/' . $imageName;
        }

        $article->save();

        return redirect()->route('admin.makaleler.index')->with('success', 'Makale başarıyla oluşturuldu.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('back.articles.update', ['categories' => $categories, 'article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->category_id = $request->input('category');
        $article->content = $request->input('content');
        $article->slug = Str::slug($request->input('title'));

        // Handle file upload
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('title')) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $article->image = 'uploads/' . $imageName;
        }

        $article->save();

        return redirect()->route('admin.makaleler.index')->with('success', 'Makale başarıyla güncellendi.');
    }

    /**
     * Update the status of the specified resource.
     */
    public function switch(Request $request)
    {
        $article = Article::findOrFail($request->id);
        $article->status = $request->statu == "true" ? 1 : 0; // Corrected spelling of 'statu'

        $article->save();
    }



    /**
     * Delete the specified resource.
     */
    public function delete($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->delete();
            return redirect()->route('admin.makaleler.index')->with('success', 'Makale başarıyla silindi.');
        }

        return redirect()->route('admin.makaleler.index')->with('error', 'Makale bulunamadı.');
    }

    /**
     * Show trashed resources.
     */
    public function trashed()
    {
        $articles = Article::onlyTrashed()->orderBy('deleted_at', 'ASC')->get();
        return view('back.articles.trashed', ['articles' => $articles]);
    }

    /**
     * Recover the specified resource.
     */
    public function recover($id)
    {
        $article = Article::onlyTrashed()->find($id);

        if ($article) {
            $article->restore();
            return redirect()->route('admin.makaleler.index')->with('success', 'Makale başarıyla geri yüklendi.');
        }

        return redirect()->route('admin.makaleler.index')->with('error', 'Makale bulunamadı.');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function destroy($id)
    {
        $article = Article::withTrashed()->find($id);

        if ($article) {
            // Delete the article's image from storage if it exists
            if (File::exists(public_path($article->image))) {
                File::delete(public_path($article->image));
            }

            $article->forceDelete();
            return redirect()->route('admin.makaleler.index')->with('success', 'Makale kalıcı olarak silindi.');
        }

        return redirect()->route('admin.makaleler.index')->with('error', 'Makale bulunamadı.');
    }
}
