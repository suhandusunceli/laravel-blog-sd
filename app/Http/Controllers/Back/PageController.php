<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::all(); // Assuming you have a category relationship
        return view('back.pages.index', ['pages' => $pages]);
    }


    public function orders(Request $request)
    {
        foreach($request->get('page') as $key => $order) {
            Page::where('id', $order)->update(['order' => $key]);
        }
    }


    /**
     * Show the form for creating a new resource.
     */

    public function switch(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->status = $request->statu == "true" ? 1 : 0;
        $page->save();

        return response()->json(['success' => true]); // Return JSON response
    }



    public function create()
    {
      return view('back.pages.create');
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

        $last = Page::max('order');

        $page = new Page();
        $page->title = $request->input('title');
        $page->content = $request->input('content');
        $page->order = $last ? $last + 1 : 1;
        $page->slug = Str::slug($request->input('title'));

        // Handle file upload
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->input('title')) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $page->image = 'uploads/' . $imageName;
        }

        $page->save();

        return redirect()->route('admin.page.index')->with('success', 'Sayfa başarıyla oluşturuldu.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page=Page::findOrFail($id);
        return view('back.pages.update',['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        $page = Page::findOrFail($id);
        $oldImage = $page->image;
        $page->title = $request->input('title');
        $page->content = $request->input('content');
        $page->slug = Str::slug($request->input('title'));

        // Handle file upload
        if ($request->hasFile('image')) {
            if (File::exists(public_path($oldImage))) {
                File::delete(public_path($oldImage));
            }

            $imageName = Str::slug($request->input('title')) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $page->image = 'uploads/' . $imageName;
        }

        $page->save();

        return redirect()->route('admin.page.index')->with('success', 'Sayfa başarıyla güncellendi.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::find($id);

        if ($page) {
            // Delete the page's image from storage if it exists
            if (File::exists(public_path($page->image))) {
                File::delete(public_path($page->image));
            }

            $page->delete();
            return redirect()->route('admin.page.index')->with('success', 'Sayfa kalıcı olarak silindi.');
        }

        return redirect()->route('admin.page.index')->with('error', 'Sayfa bulunamadı.');
    }

}
