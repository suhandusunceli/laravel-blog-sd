<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = ['Hakkımızda','Kariyer','Vizyonumuz','Misyonumuz'];
        $count=0;

        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'slug'  => Str::slug($page),
                'image' =>'http://blogsd.127.0.0.1.xip.io/front/img/hak-bg.jpg',
                'content'=>'Lorem ipsum dolor sit amet,
                 consectetur adipiscing elit. Vestibulum dapibus odio in est aliquet luctus.
                 Integer nec lorem mauris. Sed nec urna vitae justo feugiat interdum.
                 Quisque nec odio at tellus scelerisque condimentum.
                 Ut sagittis sodales arcu, id convallis risus cursus in.
                 Fusce eget purus at lacus blandit gravida. Cras eu lacus vitae quam molestie pulvinar.
                 Integer lacinia nunc vel felis tempor, a suscipit ligula venenatis. Nulla facilisi.',
                'order'=>$count,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
    }
}
