<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // konfigurasi navigation
        $konfigurasi = Navigation::create([
            'name' => 'Konfigurasi',
            'url' => 'konfigurasi',
            'icon' => 'ti-settings',
            'main_menu' => null,
        ]);
        $konfigurasi->subMenus()->create([
            'name' => 'Roles',
            'url' => 'konfigurasi/roles',
            'icon' => '',
            'main_menu' => '1',
        ]);
        $konfigurasi->subMenus()->create([
            'name' => 'Permissions',
            'url' => 'konfigurasi/permissions',
            'icon' => '',
            'main_menu' => '1',
        ]);
        // Users navigation
        $user = Navigation::create([
            'name' => 'Users',
            'url' => 'user',
            'icon' => 'ti-user',
            'main_menu' => null,
        ]);
        $user->subMenus()->create([
            'name' => 'admin',
            'url' => 'users/admin',
            'icon' => '',
        ]);
        $user->subMenus()->create([
            'name' => 'Customers',
            'url' => 'users/customers',
            'icon' => '',
        ]);

        // services navigation
        $store = Navigation::create([
            'name' => 'Store',
            'url' => 'store',
            'icon' => 'ti-shopping-cart',
            'main_menu' => null,
        ]);
        $store->subMenus()->create([
            'name' => 'Kategori',
            'url' => 'store/kategori_layanans',
            'icon' => '',
            'main_menu' => '',
        ]);
        $store->subMenus()->create([
            'name' => 'Layanan',
            'url' => 'store/layanans',
            'icon' => '',
            'main_menu' => '',
        ]);
        $store->subMenus()->create([
            'name' => 'Galeri',
            'url' => 'store/galeris',
            'icon' => '',
            'main_menu' => '',
        ]);

        // blog navigation
        $blog = Navigation::create([
            'name' => 'Blog',
            'url' => 'blog',
            'icon' => 'ti-book',
            'main_menu' => null,
        ]);
        $blog->subMenus()->create([
            'name' => 'Kategori',
            'url' => 'blog/kategori_posts',
            'icon' => '',
            'main_menu' => '',
        ]);
        $blog->subMenus()->create([
            'name' => 'Post',
            'url' => 'blog/posts',
            'icon' => '',
            'main_menu' => '',
        ]);

        $transaction = Navigation::create([
            'name' => 'Transaction',
            'url' => 'transaction',
            'icon' => 'ti-receipt',
            'main_menu' => null,
        ]);
        $transaction->subMenus()->create([
            'name' => 'Order',
            'url' => 'transaction/orders',
            'icon' => '',
            'main_menu' => null,
        ]);
        // $transaction->subMenus()->create([
        //     'name' => 'Laporan',
        //     'url' => 'transaction/laporans',
        //     'icon' => '',
        //     'main_menu' => null,
        // ]);
    }
}
