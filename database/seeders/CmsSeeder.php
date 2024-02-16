<?php

namespace Database\Seeders;

use App\Models\Cms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'page_name' => 'Privacy Policy', 'slug' => 'privacy-policy', 'title' => 'Privacy Policy', 'is_active' => 1, 'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod obcaecati rem animi incidunt quo ad dolores repellat. Quidem molestiae, ratione rerum sapiente rem enim officia eligendi nostrum hic, minus veritatis.'
            ],
            [
                'page_name' => 'Terms and Conditions', 'slug' => 'terms-and-conditions', 'title' => 'Terms and Condition', 'is_active' => 1, 'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod obcaecati rem animi incidunt quo ad dolores repellat. Quidem molestiae, ratione rerum sapiente rem enim officia eligendi nostrum hic, minus veritatis.'
            ],
        ];

        foreach ($data as $key => $value) {
            $cms = new Cms();
            $cms->page_name = $value['page_name'];
            $cms->slug = $value['slug'];
            $cms->title = $value['title'];
            $cms->is_active = $value['is_active'];
            $cms->content = $value['content'];
            $cms->save();
        }
    }
}
