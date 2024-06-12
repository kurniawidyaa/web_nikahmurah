<?php

namespace Database\Seeders;

use App\Models\KategoriLayanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dekorasi = KategoriLayanan::create([
            'name' => 'Dekorasi',
            'identifier' => 'dekorasi',
        ]);
        $dokumentasi = KategoriLayanan::create([
            'name' => 'Dokumentasi',
            'identifier' => 'dokumentasi',
        ]);
        $hiburan = KategoriLayanan::create([
            'name' => 'Hiburan',
            'identifier' => 'hiburan',
        ]);
        $mua_busana = KategoriLayanan::create([
            'name' => 'MUA & Busana',
            'identifier' => 'mua_busana',
        ]);
        $adat_kirab = KategoriLayanan::create([
            'name' => 'Adat & Kirab',
            'identifier' => 'adat_kirab',
        ]);
        $catering = KategoriLayanan::create([
            'name' => 'Catering',
            'identifier' => 'catering',
        ]);

        // layanan
        $add_value = [
            'discount_id' => null,
        ];

        $dekorasi->subLayanans()->create(array_merge([
            'category_id' => $dekorasi->id,
            'name' => 'Dekorasi Silver',
            'identifier' => 'dekorasi-silver',
            'thumbnail' => 'images/layanan/NMT240528_dekorasi5.jpg',
            'description' => '  <p>Tenda 80m2 - 100m2</p>
                            <p>Pelaminan 4m - 6m </p>
                            <p>Kursi Pelaminan</p>
                            <p>Mini Garden Pelaminan</p>
                            <p>Pergola</p>
                            <p>Standing Flower Pelaminan</p>
                            <p>Kotak Uang</p>
                            <p>Kursi Futura 100</p>
                            <p>Meja Prasmanan 1 set</p>
                            <p>Pemanas Rooltop 4</p>
                            <p>Sangku Nasi</p>
                            <p>Piring Sendok Garpu 150</p>
                            <p>Meja Tamu 1 set</p>
                            <p>Gubukan 2</p>
                            <p>Dekor Meja Akad & Kursi Tiffany</p>
                            <p>Janur 1</p>',
            'note' => '',
            'qty' => 1,
            'price' => 13000000,
        ], $add_value));

        $dekorasi->subLayanans()->create(array_merge([
            'category_id' => $dekorasi->id,
            'name' => 'Dekorasi Gold',
            'identifier' => 'dekorasi-gold',
            'thumbnail' => 'images/layanan/NMT240528_dekorasi9.jpg',
            'description' => '  <p>Tenda 120m2 - 150m2</p>
                            <p>Pelaminan 6m - 8m</p>
                            <p>Kursi Pelaminan</p>
                            <p>Mini Garden Pelaminan</p>
                            <p>Pergola</p>
                            <p>Gajebo</p>
                            <p>Standing Flower Pelaminan</p>
                            <p>Full Karpet</p>
                            <p>Kotak Uang</p>
                            <p>Kursi Futura 100 + Cover</p>
                            <p>Meja Prasmanan 1 set</p>
                            <p>Pemanas Rooltop 5</p>
                            <p>Sangku Nasi 1</p>
                            <p>Piring Sendok Garpu 200</p>
                            <p>Meja Tamu 1 set</p>
                            <p>Gubukan 3</p>
                            <p>Dekor Meja Akad & Kursi Tiffany</p>
                            <p>Blower</p>
                            <p>Janur 1</p>',
            'note' => '-',
            'qty' => 1,
            'price' => 16000000,
        ], $add_value));

        $dekorasi->subLayanans()->create(array_merge([
            'category_id' => $dekorasi->id,
            'name' => 'Dekorasi Platinum',
            'identifier' => 'dekorasi-platinum',
            'thumbnail' => 'images/layanan/NMT240528_dekorasi6.jpg',
            'description' => '  <p>Tenda 180m2 - 200m2</p>
                            <p>Pelaminan 8m - 10m</p>
                            <p>Kursi Pelaminan</p>
                            <p>Mini Garden Pelaminan</p>
                            <p>Pergola</p>
                            <p>Standing Flower Pelaminan</p>
                            <p>Standing Flower jalan 6</p>
                            <p>Full Karpet</p>
                            <p>Kotak Uang</p>
                            <p>Kursi Futura 150 + Cover</p>
                            <p>Meja Prasmanan 1 set</p>
                            <p>Pemanas Rooltop 8</p>
                            <p>Sangku Nasi 2</p>
                            <p>Piring Sendok Garpu 300</p>
                            <p>Meja Tamu 1 set</p>
                            <p>Gubukan 4</p>
                            <p></p>
                            <p>Dekor Meja Akad & Kursi Tiffany</p>
                            <p>Blower 3</p>
                            <p>Janur 1</p>
                            <p>Backdrop Photobooth</p>',
            'note' => '-',
            'qty' => 1,
            'price' => 22000000,
        ], $add_value));

        $mua_busana->subLayanans()->create(array_merge([
            'category_id' => $mua_busana->id,
            'name' => 'akad-gold',
            'identifier' => 'Akad Gold',
            'thumbnail' => 'images/layanan/NMT240528_dekorasi8.jpg',
            'description' => '  <p>Makeup + Busana Akad Pengantin Wanita</p>
                            <p>Beskap/Jas Pengantin Pria</p>
                            <p>Makeup Ibu + Kebaya Ibu 2 Pasang</p>
                            <p>Beskap Bapak 2 Pasang</p>
                            <p>Ronce Melati 1 Pasang</p>
                            <p>Aksesoris Pengantin</p>',
            'note' => '-',
            'qty' => 1,
            'price' => 5000000,
        ], $add_value));

        $mua_busana->subLayanans()->create(array_merge([
            'category_id' => $mua_busana->id,
            'name' => 'Resepsi Silver',
            'identifier' => 'resepsi-silver',
            'thumbnail' => 'images/layanan/NMT240528_dekorasi14.jpg',
            'description' => '  <p>Makeup + Busana Akad Pengantin Wanita</p>
                            <p>Makeup + Busana Resepsi Pengantin Wanita</p>
                            <p>Beskap/Jas Pengantin Pria 2</p>
                            <p>Makeup Ibu + Kebaya Ibu 2 Pasang</p>
                            <p>Beskap Bapak 2 Pasang</p>
                            <p>Ronce Melati 1 Pasang</p>
                            <p>Aksesoris Pengantin + Aksesoris Orang Tua</p>
                            <p>Makeup + Busana Penerima Tamu 4 orang</p>
                            <p>Makeup among tamu 4 orang (Tanpa busana)</p>
                            <p>Henna</p>
                            <p>Soflens</p>
                            <p>Handbouquet</p>',
            'note' => '-',
            'qty' => 10,
            'price' => 7000000,
        ], $add_value));

        $mua_busana->subLayanans()->create(array_merge([
            'category_id' => $mua_busana->id,
            'name' => 'Resepsi Gold',
            'identifier' => 'resepsi-gold',
            'thumbnail' => 'images/layanan/NMT240528_dekorasi7.jpg',
            'description' => '  <p>Makeup + Busana Akad Pengantin Wanita</p>
                            <p>Makeup + Busana Resepsi Pengantin Wanita</p>
                            <p>Beskap/Jas Pengantin Pria 2</p>
                            <p>Makeup Ibu + Kebaya Ibu 2 Pasang</p>
                            <p>Beskap Bapak 2 Pasang</p>
                            <p>Ronce Melati 1 Pasang</p>
                            <p>Aksesoris Pengantin + Aksesoris Orang Tua</p>',
            'note' => '-',
            'qty' => 10,
            'price' => 9000000,
        ], $add_value));
        // resepsi platinum
        $mua_busana->subLayanans()->create(array_merge([
            'category_id' => $mua_busana->id,
            'name' => 'Resepsi Platinum',
            'identifier' => 'resepsi-platinum',
            'thumbnail' => 'images/layanan/NMT240528_dekorasi12.jpg',
            'description' => '  <p>Makeup + Busana Akad Pengantin Wanita</p>
                            <p>Makeup + Busana Resepsi Pengantin Wanita ( 2 kali ganti )</p>
                            <p>Beskap/Jas Pengantin Pria 2</p>
                            <p>Makeup Ibu + Kebaya Ibu 2 Pasang</p>
                            <p>Beskap Bapak 2 Pasang</p>
                            <p>Ronce Melati 1 Pasang</p>
                            <p>Aksesoris Pengantin + Aksesoris Orang Tua</p>
                            <p>Makeup + Busana Penerima Tamu 4 orang</p>
                            <p>Makeup + Busana among tamu 4 orang</p>
                            <p>Henna</p>
                            <p>Soflens</p>
                            <p>Handbouquet</p>',
            'note' => '-',
            'qty' => 10,
            'price' => 10000000,
        ], $add_value));

        $dokumentasi->subLayanans()->create(array_merge([
            'category_id' => $dokumentasi->id,
            'name' => 'Foto & Video',
            'identifier' => 'foto-video',
            'thumbnail' => 'images/layanan/NMT240528_dokumentasi2.jpg',
            'description' => '<p>2 Foto 30x40 Canvas + frame</p>
                              <p>1 Album kolase (20 Halaman)</p>
                              <p>Video Dokumentasi (5-10 menit)</p>
                              <p>Video Cinematic (1 menit)</p>
                              <p>1 Flashdisk isi softcopy foto dan video</p>',
            'note' => '-',
            'qty' => 10,
            'price' => 3000000,
        ]), $add_value);
        // foto, video, photobooth
        $dokumentasi->subLayanans()->create(array_merge([
            'category_id' => $dokumentasi->id,
            'name' => 'Foto, Video & Photobooth',
            'identifier' => 'fotovideo-photobooth',
            'thumbnail' => 'images/layanan/NMT240528_dokumentasi4.jpg',
            'description' => '<p>2 Foto 30x40 Canvas + frame</p>
                              <p>1 Album kolase (20 Halaman)</p>
                              <p>Video Dokumentasi (5-10 menit)</p>
                              <p>Video Cinematic (1 menit)</p>
                              <p>1 Flashdisk isi softcopy foto dan video</p>
                              <p>Photobooth unlimited <b>(Durasi Maksimal 8 jam)</b></p>',
            'note' => '-',
            'qty' => 10,
            'price' => 3000000,
        ]), $add_value);

        // organ tunggal
        $hiburan->subLayanans()->create(array_merge([
            'category_id' => $hiburan->id,
            'name' => 'Paket OT (Organ tunggal) 1',
            'identifier' => 'ot-1',
            'thumbnail' => 'images/layanan/NMT240528_ot1.jpg',
            'description' => '<p>1 Singer</p>
                              <p>1 Player + Keyboard</p>
                              <p>1 set Sound System 2000 watt</p>',
            'note' => '<b>Durasi Maksimal 3 Jam</b>',
            'qty' => 10,
            'price' => 2500000,
        ]), $add_value);

        $hiburan->subLayanans()->create(array_merge([
            'category_id' => $hiburan->id,
            'name' => 'Paket OT (Organ tunggal) 2',
            'identifier' => 'ot-2',
            'thumbnail' => 'images/layanan/NMT240528_ot2.jpg',
            'description' => '<p>2 Singer</p>
                              <p>1 Player + Keyboard</p>
                              <p>1 set Sound System 2000 watt</p>',
            'note' => '<b>Durasi Maksimal 6 Jam</b>',
            'qty' => 10,
            'price' => 3000000,
        ]), $add_value);

        $hiburan->subLayanans()->create(array_merge([
            'category_id' => $hiburan->id,
            'name' => 'Paket OT (Organ tunggal) 3',
            'identifier' => 'ot-3',
            'thumbnail' => 'images/layanan/NMT240528_ot3.jpg',
            'description' => '<p>2 Singer</p>
                              <p>1 Player + Keyboard</p>
                              <p>1 set Sound System 2000 watt</p>',
            'note' => '<b>Durasi Maksimal 10 Jam</b>',
            'qty' => 10,
            'price' => 3500000,
        ]), $add_value);
        // Akustik
        $hiburan->subLayanans()->create(array_merge([
            'category_id' => $hiburan->id,
            'name' => 'Paket Akustik Minimalis',
            'identifier' => 'akustik-minimalis',
            'thumbnail' => 'images/layanan/NMT240528_akustikminimalis.png',
            'description' => '<p>1 Singer (Male or Female)</p>
                              <p>1 Gitar</p>
                              <p>1 Cajon</p>
                              <p>1 set Sound System 2000 watt</p>',
            'note' => '<b>Durasi Maksimal 3 Jam</b>
            <br><b>Extra Time Akustik Rp.750.000 per jam</b',
            'qty' => 10,
            'price' => 3000000,
        ]), $add_value);

        $hiburan->subLayanans()->create(array_merge([
            'category_id' => $hiburan->id,
            'name' => 'Paket Akustik Elegant',
            'identifier' => 'akustik-elegant',
            'thumbnail' => '',
            'description' => '<p>1 Singer (Male or Female)</p>
                              <p>1 Keyboard</p>
                              <p>1 Drum Elektrik</p>
                              <p>1 Saxophone / Biola (Include kirab)</p>
                              <p>1 Bass</p>
                              <p>1 set Sound System 2000 watt</p>',
            'note' => '<b>Durasi Maksimal 3 Jam</b>
                        <br><b>Extra Time Akustik Rp.750.000 per jam</b>',
            'qty' => 10,
            'price' => 5000000,
        ]), $add_value);

        // adat kirab
        $adat_kirab->subLayanans()->create(array_merge([
            'category_id' => $adat_kirab->id,
            'name' => 'Upacara Adat Jawa',
            'identifier' => 'adat-jawa',
            'thumbnail' => 'images/layanan/NMT240528_upacarajawa.jpg',
            'description' => '<p>MC Adat</p>
                              <p>Cucuk Lampah</p>
                              <p>Peralatan Upacara</p>',
            'note' => '<b>Tidak termasuk nasi kuning dan bekakak ayam</b>',
            'qty' => 10,
            'price' => 2500000,
        ]), $add_value);

        $adat_kirab->subLayanans()->create(array_merge([
            'category_id' => $adat_kirab->id,
            'name' => 'Upacara Adat Sunda',
            'identifier' => 'adat-sunda',
            'thumbnail' => 'images/layanan/NMT240528_upacarasunda.jpg',
            'description' => '<p>MC Upacara Sunda</p>
                              <p>Mang Lengser</p>
                              <p>Pembawa Payung</p>
                              <p>Peralatan Upacara</p>',
            'note' => '<b>Tidak termasuk nasi kuning dan bekakak ayam dan receh sawer</b>',
            'qty' => 10,
            'price' => 2500000,
        ]), $add_value);

        // kirab
        $adat_kirab->subLayanans()->create(array_merge([
            'category_id' => $adat_kirab->id,
            'name' => 'Kirab Gatot Kaca',
            'identifier' => 'kirab',
            'thumbnail' => 'images/layanan/NMT240528_gatotkaca.jpg',
            'description' => '<p>Gatot Kaca (Single)</p>',
            'note' => '-',
            'qty' => 10,
            'price' => 1200000,
        ]), $add_value);
        $adat_kirab->subLayanans()->create(array_merge([
            'category_id' => $adat_kirab->id,
            'name' => 'Kirab Cucuk Lampah',
            'identifier' => 'cucuk-lampah',
            'thumbnail' => 'images/layanan/NMT240528_cucuklampah.jpeg',
            'description' => '<p>Cucuk Lampah</p>',
            'note' => '-',
            'qty' => 10,
            'price' => 1200000,
        ]), $add_value);
        $adat_kirab->subLayanans()->create(array_merge([
            'category_id' => $adat_kirab->id,
            'name' => 'Kirab Cucuk Lampah & MC Nyondro',
            'identifier' => 'mc-nyondro',
            'thumbnail' => 'images/layanan/NMT240528_mcnyondro.jpg',
            'description' => '<p>Cucuk Lampah & MC Nyondro</p>',
            'note' => '-',
            'qty' => 10,
            'price' => 1500000,
        ]), $add_value);
        $adat_kirab->subLayanans()->create(array_merge([
            'category_id' => $adat_kirab->id,
            'name' => 'Kirab Aki Lengser & Pembawa Payung',
            'identifier' => 'aki-lengser',
            'thumbnail' => 'images/galeri/NMT240528_akilengser.jpg',
            'description' => '<p>Aki Lengser & Pembawa Payung</p>',
            'note' => '-',
            'qty' => 10,
            'price' => 1500000,
        ]), $add_value);
        // catering
        $catering->subLayanans()->create(array_merge([
            'category_id' => $catering->id,
            'name' => 'Paket Prasmanan Ekonomis',
            'identifier' => 'ekonomis',
            'thumbnail' => 'images/layanan/NMT240528_prasmananekonomis.jpeg',
            'description' => '<p>Paket Ekonomis Rp.40.000 per Pax/Porsi</p>',
            'note' => 'Untuk Pilihan Menu Silahkan Chat Via WA, Minimal Order 200 pax/porsi,
            Harga sudah termasuk waiters (pelayan) dan kebersihan.',
            'qty' => 10,
            'price' => 8000000,
        ]), $add_value);
        $catering->subLayanans()->create(array_merge([
            'category_id' => $catering->id,
            'name' => 'Paket Prasmanan VIP',
            'identifier' => 'vip',
            'thumbnail' => 'images/layanan/NMT240528_prasmananvip.jpg',
            'description' => '<p>Paket VIP Rp.50.000 per Pax/Porsi</p>',
            'note' => 'Untuk Pilihan Menu Silahkan Chat Via WA, Minimal Order 200 pax/porsi,
            Harga sudah termasuk waiters (pelayan) dan kebersihan.',
            'qty' => 10,
            'price' => 10000000,
        ]), $add_value);
        $catering->subLayanans()->create(array_merge([
            'category_id' => $catering->id,
            'name' => 'Paket Nasi Box Ekonomis',
            'identifier' => 'ekonomis',
            'thumbnail' => 'images/layanan/NMT240528_nasiekonomis.jpg',
            'description' => '<p>Nasi Box Ekonomis Rp.30.000 per Pax/Porsi</p>',
            'note' => 'Untuk Pilihan Menu Silahkan Chat Via WA, Minimal Order 100 Box, Harga
            sudah termasuk ongkir diwilayah Tangerang raya dan daerah tertentu di
            Jakarta.',
            'qty' => 10,
            'price' => 3000000,
        ]), $add_value);
        $catering->subLayanans()->create(array_merge([
            'category_id' => $catering->id,
            'name' => 'Paket Nasi Box VIP',
            'identifier' => 'vip',
            'thumbnail' => 'images/layanan/NMT240528_nasivip.jpeg',
            'description' => '<p>Nasi Box VIP Rp.35.000 per Pax/Porsi</p>',
            'note' => 'Untuk Pilihan Menu Silahkan Chat Via WA, Minimal Order 100 Box, Harga
            sudah termasuk ongkir diwilayah Tangerang raya dan daerah tertentu di
            Jakarta.',
            'qty' => 10,
            'price' => 3500000,
        ]), $add_value);
    }
}
