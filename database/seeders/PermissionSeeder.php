<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'read konfigurasi']);
        // create permission role 
        Permission::create(['name' => 'read konfigurasi/roles']);
        Permission::create(['name' => 'create konfigurasi/roles']);
        Permission::create(['name' => 'update konfigurasi/roles']);
        Permission::create(['name' => 'delete konfigurasi/roles']);
        // create permission permissions 
        Permission::create(['name' => 'read konfigurasi/permissions']);
        Permission::create(['name' => 'create konfigurasi/permissions']);
        Permission::create(['name' => 'update konfigurasi/permissions']);
        Permission::create(['name' => 'delete konfigurasi/permissions']);

        Permission::create(['name' => 'read store']);
        // create permission layanan
        Permission::create(['name' => 'read store/layanans']);
        Permission::create(['name' => 'create store/layanans']);
        Permission::create(['name' => 'update store/layanans']);
        Permission::create(['name' => 'delete store/layanans']);
        // create permissions kategori layanan
        Permission::create(['name' => 'read store/kategori_layanans']);
        Permission::create(['name' => 'create store/kategori_layanans']);
        Permission::create(['name' => 'update store/kategori_layanans']);
        Permission::create(['name' => 'delete store/kategori_layanans']);
        // create permissions gallery
        Permission::create(['name' => 'read store/galeris']);
        Permission::create(['name' => 'create store/galeris']);
        Permission::create(['name' => 'show store/galeris']);
        Permission::create(['name' => 'update store/galeris']);
        Permission::create(['name' => 'delete store/galeris']);

        Permission::create(['name' => 'read blog']);
        // create permissions kategori post
        Permission::create(['name' => 'read blog/kategori_posts']);
        Permission::create(['name' => 'create blog/kategori_posts']);
        Permission::create(['name' => 'update blog/kategori_posts']);
        Permission::create(['name' => 'delete blog/kategori_posts']);
        // create permissions blog/posts
        Permission::create(['name' => 'read blog/posts']);
        Permission::create(['name' => 'create blog/posts']);
        Permission::create(['name' => 'publish blog/posts']);
        Permission::create(['name' => 'unpublish blog/posts']);
        Permission::create(['name' => 'update blog/posts']);
        Permission::create(['name' => 'delete blog/posts']);

        Permission::create(['name' => 'read transaction']);
        Permission::create(['name' => 'read transaction/orders']);
        Permission::create(['name' => 'show transaction/orders']);
        Permission::create(['name' => 'update transaction/orders']);
        Permission::create(['name' => 'delete transaction/orders']);

        Permission::create(['name' => 'show orders']);
        Permission::create(['name' => 'read orders']);
        Permission::create(['name' => 'read payment']);

        Permission::create(['name' => 'pdf proses']);
        Permission::create(['name' => 'pdf laporan']);

        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);
    }
}
