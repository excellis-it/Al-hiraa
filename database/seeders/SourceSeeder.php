<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sorces = [
            'Telecalling',
            'Reference',
            'Facebook',
            'Instagram',
            'Others'
        ];

        foreach ($sorces as $key => $value) {
            $source = new Source();
            $source->name = $value;
            $source->save();
        }
    }
}
