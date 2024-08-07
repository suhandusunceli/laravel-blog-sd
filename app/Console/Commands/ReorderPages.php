<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;

class ReorderPages extends Command
{
    protected $signature = 'pages:reorder';
    protected $description = 'Reorder pages to fix order gaps';

    public function handle()
    {
        // En yüksek `order` değerini al
        $pages = Page::orderBy('order')->get();

        // `order` değerlerini yeniden düzenleyin
        foreach ($pages as $index => $page) {
            $page->order = $index + 1;
            $page->save();
        }

        $this->info('Pages reordered successfully.');
    }
}
