<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class Dashboard extends Controller
{
    public function index()
    {
        // Eager loading ile sayıları daha performanslı bir şekilde almak için
        $articleCount = Article::count();
        $totalHits = Article::sum('hit');
        $categoryCount = Category::count();

        return view('back.dashboard', [
            'article' => $articleCount,
            'hit' => $totalHits,
            'category' => $categoryCount
        ]);
    }
}
