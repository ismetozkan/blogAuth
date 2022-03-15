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
     *
     * @return void
     */
    public function run()
    {
        $pages = ['About Us', 'Career','Mission'];
        $count=0;
        foreach ($pages as $page) {
            $count++;
            DB::table('pages')->insert([
                'title' => $page,
                'slug' => Str::slug($page),
                'order'=>$count,
                'image'=>'https://utechia.com/wp-content/uploads/2021/11/business-foto.jpeg',
                'content'=>'Lorem Ipsum is simply dummy text of the
                            printing and typesetting industry. Lorem
                            Ipsum has been the industry standard dummy text ever since
                            the 1500s when an unknown printer took a galley of  scrambled it to make
                            type specimen book It has survived not only five centuries but also the leap
                            nto electronic typesetting remaining essentially unchanged It was popularised in
                            the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and
                            ore recently with desktop publishing software like  Lorem Ipsum',

                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
