<?php

namespace Database\Seeders;

use App\Models\KategoriPost;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
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
        KategoriPost::create(array_merge([
            'name' => 'Lamaran',
            'slug' => 'lamaran',
        ], $default_value));
        KategoriPost::create(array_merge([
            'name' => 'Ide Pernikahan',
            'slug' => 'ide-pernikahan',
        ], $default_value));
        KategoriPost::create(array_merge([
            'name' => 'Hubungan',
            'slug' => 'hubungan',
        ], $default_value));
        KategoriPost::create(array_merge([
            'name' => 'Fiqih Rumah Tangga',
            'slug' => 'fiqih-rumah-tangga',
        ], $default_value));

        Post::create(array_merge([
            'author_id' => 1,
            'category_id' => 2,
            'title' => "Tips memilih Wedding organizer",
            'slug' => 'tips-memilih-wedding-organizer',
            'thumbnail' => 'NMT240601_post.NMT240528_dekorasi1.jpg',
            'excerpt' => "Dalam Penyelenggaraan acara pernikahan peran Wedding organizer sangat dibutuhkan, terutama jika pesta pernikahan diadakan dalam skala besar untuk merancang konsep pesta maupun memastikan acara berjalan dengan baik sesuai harapan.",
            'body' => "Dalam Penyelenggaraan acara pernikahan peran Wedding organizer sangat dibutuhkan, terutama jika pesta pernikahan diadakan dalam skala besar untuk merancang konsep pesta maupun memastikan acara berjalan dengan baik sesuai harapan.
            <br><br>
            Tips Memilih Wedding Organizer yang Tepat untuk Pernikahan Anda
            Pernikahan adalah momen yang istimewa dalam kehidupan setiap pasangan. Namun, menyelenggarakan sebuah pernikahan bisa menjadi tugas yang menantang dan memakan waktu. Inilah mengapa banyak pasangan memilih untuk menggunakan jasa wedding organizer (WO) untuk membantu merencanakan dan mengelola acara pernikahan mereka. Namun, memilih wedding organizer yang tepat adalah langkah penting untuk memastikan bahwa pernikahan Anda berjalan lancar sesuai dengan yang Anda impikan. Berikut adalah beberapa tips untuk memilih wedding organizer yang tepat:
            <br><br>
            1. Tentukan Anggaran Anda
            Sebelum memilih wedding organizer, tentukan terlebih dahulu anggaran yang Anda miliki untuk pernikahan Anda. Ini akan membantu Anda mempersempit pilihan dan menemukan wedding organizer yang sesuai dengan kebutuhan dan anggaran Anda.
            <br><br>
            2. Cari Referensi dan Ulasan
            Mencari referensi dari teman, keluarga, atau mencari ulasan online dapat memberikan wawasan berharga tentang kualitas layanan wedding organizer tersebut. Pastikan untuk melihat portofolio pekerjaan mereka dan ulasan dari klien sebelumnya.
            <br><br>
            3. Pertimbangkan Pengalaman dan Spesialisasi
            Pilihlah wedding organizer yang memiliki pengalaman yang cukup dalam industri pernikahan dan memiliki spesialisasi dalam jenis pernikahan yang Anda inginkan, apakah itu pernikahan tradisional, tema tertentu, atau pernikahan destinasi.
            <br><br>
            4. Komunikasi yang Efektif
            Komunikasi yang baik antara Anda dan wedding organizer sangat penting. Pastikan wedding organizer tersebut mudah dihubungi dan responsif terhadap pertanyaan dan permintaan Anda.
            <br><br>
            5. Pertemuan Langsung
            Sebelum memutuskan, jadwalkan pertemuan langsung dengan wedding organizer yang Anda pertimbangkan. Gunakan kesempatan ini untuk mengajukan pertanyaan lebih lanjut, melihat contoh-contoh pekerjaan mereka, dan menilai apakah mereka cocok dengan gaya dan visi pernikahan Anda.
            <br><br>
            6. Perhatikan Detail
            Pilihlah wedding organizer yang perhatian terhadap detail. Hal-hal kecil seringkali membuat perbedaan dalam keseluruhan pengalaman pernikahan Anda. Pastikan mereka dapat memperhatikan preferensi Anda dan menjaga segala sesuatunya berjalan lancar.
            <br><br>
            7. Periksa Ketersediaan
            Pastikan wedding organizer yang Anda pilih tersedia pada tanggal pernikahan Anda dan siap bekerja sesuai dengan jadwal yang telah Anda tetapkan.
            <br><br>
            Memilih Nikah Murah Tangerang sebagai Alternatif Menarik
            Salah satu wedding organizer yang patut dipertimbangkan, terutama bagi pasangan yang ingin memiliki pernikahan yang indah tanpa harus menguras kantong adalah Nikah Murah Tangerang. Mereka menawarkan paket-paket pernikahan yang terjangkau tanpa mengorbankan kualitas. Dengan tim yang berpengalaman dan berkomitmen untuk memberikan pelayanan terbaik kepada setiap klien, Nikah Murah Tangerang telah menjadi pilihan favorit bagi pasangan yang menginginkan pernikahan impian tanpa membebani anggaran mereka.
            <br><br>
            Nikah Murah Tangerang tidak hanya menawarkan paket pernikahan yang lengkap, tetapi juga memiliki jaringan vendor yang handal dan berkualitas tinggi, mulai dari venue hingga dekorasi, fotografi, dan layanan lainnya. Dengan demikian, pasangan bisa mempercayakan segala kebutuhan pernikahan mereka kepada Nikah Murah Tangerang tanpa perlu khawatir akan kekurangan atau biaya yang tidak terduga.
            <br><br>
            Dengan mengikuti tips di atas dan mempertimbangkan pilihan wedding organizer seperti Nikah Murah Tangerang, Anda dapat memiliki pernikahan impian tanpa stres berlebihan tentang perencanaan dan pengelolaannya. Dengan kerja sama yang baik antara Anda dan wedding organizer yang dipilih, Anda bisa menikmati momen spesial Anda tanpa khawatir tentang detail-detail teknisnya.",
            'published_at' => Carbon::now(),
        ]), $default_value);

        // artikel 2
        Post::create(array_merge([
            'author_id' => 2,
            'category_id' => 4,
            'title' => "Hukum Menikah dalam Islam dan Dalil Alquran",
            'slug' => 'hukum-menikah-dalam-islam-dan-dalil-alquran',
            'thumbnail' => 'NMT240601_post.NMT240528_dokumentasi5.jpg',
            'excerpt' => "Pernikahan merupakan sunah Rasulullah SAW dan merupakan salah satu ibadah dalam Islam. Dalam agama Islam, menikah tidak
            hanya sekadar melegalkan hubungan suami istri, tetapi juga memiliki hikmah dan tujuan mulia.",
            'body' => "Pernikahan merupakan sunah Rasulullah SAW dan merupakan salah satu ibadah dalam Islam. Dalam agama Islam, menikah tidak
            hanya sekadar melegalkan hubungan suami istri, tetapi juga memiliki hikmah dan tujuan mulia.
            <br><br>
            Allah SWT telah memerintahkan hamba-Nya untuk menikah sebagaimana firman-Nya dalam Alquran:
            <br><br>
            Dan nikahkanlah orang-orang yang masih membujang di antara kamu, dan juga orang-orang yang layak (menikah) dari
            hamba-hamba sahayamu yang laki-laki dan perempuan. Jika mereka miskin, Allah akan memberikan kemampuan kepada mereka
            dengan karunia-Nya. Dan Allah Maha Luas (karunia-Nya), Maha Mengetahui. (QS. An-Nur: 32)
            <br><br>
            Dalam ayat tersebut, Allah SWT memerintahkan untuk menikahkan orang-orang yang masih membujang dan hamba sahaya yang
            merdeka. Hal ini menunjukkan bahwa menikah merupakan salah satu perintah dari Allah SWT.
            <br><br>
            Selain itu, Rasulullah SAW juga menegaskan bahwa menikah adalah sunah beliau yang harus diikuti oleh umatnya. Dari Anas
            bin Malik, Rasulullah SAW bersabda:
            <br><br>
            Barangsiapa yang mengikuti sunnahku, maka ia termasuk golonganku. Dan barangsiapa yang tidak mengikuti sunnahku, maka
            ia bukan termasuk golonganku. (HR. Bukhari dan Muslim)
            <br><br>
            Dalam hadits lain, Rasulullah SAW juga memerintahkan kepada para pemuda untuk menikah bagi yang sudah mampu:
            <br><br>
            <p>Wahai para pemuda! Barangsiapa di antara kamu yang telah mempunyai kemampuan hendaknya ia menikah, karena menikah itu
            lebih dapat menundukkan pandangan dan lebih dapat menjaga kemaluan.<p> (HR. Bukhari dan Muslim)
            <br><br>
            Dalam Islam, hukum menikah dapat dibagi menjadi beberapa kategori:
            <br><br>
            1. Wajib, bagi orang yang telah mampu dan khawatir akan terjerumus dalam perzinaan jika tidak menikah.
            <br><br>
            2. Sunah, bagi orang yang telah mampu dan tidak khawatir akan terjerumus dalam perzinaan.
            <br><br>
            3. Mubah, bagi orang yang tidak memiliki keinginan untuk menikah dan tidak khawatir akan terjerumus dalam perzinaan.
            <br><br>
            4. Makruh, bagi orang yang tidak mampu memberi nafkah kepada istri dan keturunannya.
            <br><br>
            5. Haram, bagi orang yang berniat untuk menyakiti atau menelantarkan istrinya.
            <br><br>
            Dari penjelasan di atas, dapat disimpulkan bahwa menikah dalam Islam merupakan suatu ibadah yang dianjurkan bagi yang
            mampu agar terhindar dari perbuatan maksiat. Alquran dan hadits Rasulullah SAW menjadi pedoman utama dalam melaksanakan
            pernikahan sesuai dengan syariat Islam.",
            'published_at' => Carbon::now(),
        ]), $default_value);

        Post::create(array_merge([
            'author_id' => 2,
            'category_id' => 2,
            'title' => "Mewujudkan Pesta Pernikahan Elegant dengan Dekorasi Minimalis",
            'slug' => 'mewujudkan-pesta-pernikahan-elegant-dengan-dekorasi-minimalis',
            'thumbnail' => 'NMT240601_post.NMT240528_dekorasi6.jpg',
            'excerpt' => "Menikah adalah momen istimewa yang dinanti-nanti oleh setiap pasangan. Momen ini tentunya ingin dirayakan dengan meriah dan elegan. Namun, terkadang kendala budget menjadi penghalang untuk mewujudkan pesta impian. Jangan khawatir, dekorasi minimalis dapat menjadi solusi untuk menciptakan suasana elegan tanpa menguras dompet.",
            'body' => "Menikah adalah momen istimewa yang dinanti-nanti oleh setiap pasangan. Momen ini tentunya ingin dirayakan dengan meriah dan elegan. Namun, terkadang kendala budget menjadi penghalang untuk mewujudkan pesta impian. Jangan khawatir, dekorasi minimalis dapat menjadi solusi untuk menciptakan suasana elegan tanpa menguras dompet.
<br><br>
Berikut beberapa tips untuk mewujudkan pesta pernikahan elegant dengan dekorasi minimalis:
<br><br>
1. Pilih Venue Sederhana tapi Elegan
Mulailah dengan memilih venue yang sederhana namun memiliki sentuhan elegan. Cobalah mencari gedung atau taman dengan arsitektur klasik atau modern yang bersih dan minimalis. Dengan pemilihan venue yang tepat, Anda tidak perlu mengeluarkan banyak biaya untuk dekorasi berlebihan.
<br><br>
2. Fokus pada Penggunaan Bunga Segar
Bunga segar adalah elemen dekorasi yang dapat memberikan keanggunan pada pesta pernikahan Anda. Pilihlah bunga-bunga musiman yang mudah didapat dan terjangkau. Atur bunga-bunga tersebut di tempat-tempat strategis seperti meja utama, pintu masuk, atau backdrop foto. Dengan sentuhan bunga segar, suasana pesta akan terasa lebih segar dan elegan.
<br><br>
3. Manfaatkan Pencahayaan
Pencahayaan yang tepat dapat menciptakan suasana yang dramatis dan elegan. Gunakan lilin atau lampu sorot untuk menerangi area-area tertentu seperti meja utama atau backdrop foto. Anda juga dapat memanfaatkan pencahayaan alami dari jendela atau pintu kaca untuk memberikan efek hangat dan natural.
<br><br>
4. Gali Kreativitas dengan DIY
Jangan ragu untuk mencoba dekorasi DIY (Do It Yourself) yang murah dan unik. Anda dapat membuat backdrop foto sederhana dari kain atau kertas, membuat buket bunga dari kertas atau kain, atau bahkan membuat dekorasi meja dari bahan-bahan daur ulang. Dengan sedikit kreativitas, hasil dekorasi DIY dapat terlihat elegan dan memukau.
<br><br>
5. Pilihlah Tema Warna yang Elegan
Tema warna yang elegan dapat memberikan kesan mewah pada pesta pernikahan Anda. Pilihlah warna-warna seperti putih, krem, emas, atau warna-warna pastel yang lembut. Kombinasikan warna-warna ini pada elemen dekorasi seperti taplak meja, keramik, atau aksesoris lainnya.
<br><br>
Dengan mengikuti tips-tips di atas, Anda dapat mewujudkan pesta pernikahan yang elegan dan memukau tanpa harus menghabiskan banyak biaya. Ingatlah, dekorasi minimalis bukan berarti kurang menarik, justru dengan kreativitas dan sentuhan personal, dekorasi minimalis dapat menciptakan suasana yang elegan dan berkesan.",
            'published_at' => Carbon::now(),
        ]), $default_value);

        // Post::factory(10)->create();
    }
}
