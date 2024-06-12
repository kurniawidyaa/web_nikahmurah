<?php

namespace Database\Seeders;

use App\Models\Testimoni;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_value = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        Testimoni::create(array_merge([
            'thumbnail' => 'testi_1.jpg'
        ]), $default_value);
        Testimoni::create(array_merge([
            'thumbnail' => 'testi_2.jpg'
        ]), $default_value);
        Testimoni::create(array_merge([
            'thumbnail' => 'testi_3.jpg'
        ]), $default_value);
        Testimoni::create(array_merge([
            'thumbnail' => 'testi_4.jpg'
        ]), $default_value);
    }
}
