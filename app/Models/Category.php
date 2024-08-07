<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory; // Ensure HasFactory trait is used if you plan to use factory methods

    /**
     * Define a relationship method to get the count of articles
     * where status is 1.
     */
    public function articleCount()
    {
        // Assuming 'Article' model has 'category_id' as the foreign key
        return $this->hasMany(Article::class, 'category_id', 'id')
            ->where('status', 1) // Only count articles with status 1
            ->count(); // Get the count of such articles
    }
}
