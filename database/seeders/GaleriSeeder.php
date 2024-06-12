<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
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
        // dokumentasi
        Galeri::create(array_merge([
            'category_id' => 2,
            'thumbnail' => 'images/galeri/NMT240528_dokumentasi1.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 2,
            'thumbnail' => 'images/galeri/NMT240528_dokumentasi2.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 2,
            'thumbnail' => 'images/galeri/NMT240528_dokumentasi3.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 2,
            'thumbnail' => 'images/galeri/NMT240528_dokumentasi4.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 2,
            'thumbnail' => 'images/galeri/NMT240528_dokumentasi5.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 2,
            'thumbnail' => 'images/galeri/NMT240528_dokumentasi6.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 2,
            'thumbnail' => 'images/galeri/NMT240528_dokumentasi7.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 2,
            'thumbnail' => 'images/galeri/NMT240528_dokumentasi8.jpg'
        ]), $default_value);

        // dekorasi
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi1.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi2.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi3.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi4.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi5.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi6.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi7.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi8.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi9.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi10.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi11.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi12.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi13.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi14.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi15.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 1,
            'thumbnail' => 'images/galeri/NMT240528_dekorasi16.jpg'
        ]), $default_value);

        // hiburan
        Galeri::create(array_merge([
            'category_id' => 3,
            'thumbnail' => 'images/galeri/NMT240528_hiburan1.jpg'
        ]), $default_value);

        // mua
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_mua1.jpeg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_mua2.jpeg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_mua3.jpeg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_mua4.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_mua5.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_mua6.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_mua7.jpg'
        ]), $default_value);

        // busana
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_busana1.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_busana2.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_busana3.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_busana4.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_busana5.jpg'
        ]), $default_value);
        Galeri::create(array_merge([
            'category_id' => 4,
            'thumbnail' => 'images/galeri/NMT240528_busana6.jpg'
        ]), $default_value);
    }
}
