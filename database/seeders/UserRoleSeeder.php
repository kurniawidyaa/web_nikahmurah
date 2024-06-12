<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::beginTransaction();
        try {
            $user_default_value = [
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ];
            $owner = User::create(array_merge([
                'name' => 'Owner',
                'email' => 'owner@gmail.com',
                'phone' => '085872384199',
                'address' => 'Jl. Kebon Jeruk Raya No. 1',
                'photo' => null,
            ], $user_default_value));

            $admin = User::create(array_merge([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => '085872384199',
                'address' => 'Jl. Pinang Raya No. 20',
                'photo' => null,
            ], $user_default_value));

            // $writer = User::create(array_merge([
            //     'name' => 'writer',
            //     'email' => 'writer@gmail.com',
            //     'phone' => '085872384199',
            //     'photo' => null,
            // ], $user_default_value));

            $user = User::create(array_merge([
                'name' => 'kurnia',
                'email' => 'kurnia@gmail.com',
                'phone' => '085872384199',
                'address' => 'Jl. Palem Kuning 2 No.12',
                'photo' => null,
            ], $user_default_value));

            $user2 = User::create(array_merge([
                'name' => 'Vera',
                'email' => 'vera@gmail.com',
                'phone' => '085872384199',
                'address' => 'Jl. Tipar Timur No.4',
                'photo' => null,
            ], $user_default_value));

            $user3 = User::create(array_merge([
                'name' => 'Tiffany',
                'email' => 'tiffany@gmail.com',
                'phone' => '089874662822',
                'address' => 'Jl. Permai Baru No.24',
                'photo' => null,
            ], $user_default_value));


            $role_owner = Role::create(['name' => 'owner']);
            $role_admin = Role::create(['name' => 'admin']);
            // $role_writer = Role::create(['name' => 'writer']);
            $role_user = Role::create(['name' => 'user']);

            $owner->assignRole('owner');
            $admin->assignRole('admin');
            // $writer->assignRole('writer');
            $user->assignRole('user');
            $user2->assignRole('user');
            $user2->assignRole('user');
            $user3->assignRole('admin');

            $role_owner->givePermissionTo(Permission::all());
            $role_admin->givePermissionTo(Permission::all());
            $role_user->givePermissionTo([
                'show orders',
                'read orders',
                'read payment',
            ]);

            // $role_owner->givePermissionTo([
            //     'read konfigurasi',
            //     'read konfigurasi/roles',
            //     'create konfigurasi/roles',
            //     'update konfigurasi/roles',
            //     'delete konfigurasi/roles',
            //     'read konfigurasi/permissions',
            //     'create konfigurasi/permissions',
            //     'update konfigurasi/permissions',
            //     'delete konfigurasi/permissions',

            //     'read store',
            //     'read store/kategori_layanans',
            //     'create store/kategori_layanans',
            //     'update store/kategori_layanans',
            //     'delete store/kategori_layanans',
            //     'read store/layanans',
            //     'create store/layanans',
            //     'update store/layanans',
            //     'delete store/layanans',
            //     'read store/galeris',
            //     'create store/galeris',
            //     'show store/galeris',
            //     'update store/galeris',
            //     'delete store/galeris',

            //     'read blog',
            //     'read blog/kategori_posts',
            //     'create blog/kategori_posts',
            //     'update blog/kategori_posts',
            //     'delete blog/kategori_posts',

            //     'read blog/posts',
            //     'create blog/posts',
            //     'publish blog/posts',
            //     'unpublish blog/posts',
            //     'update blog/posts',
            //     'delete blog/posts',

            //     // 'read transaction',
            //     // 'read transaction/orders',
            //     // 'create transaction/orders',
            //     // 'update transaction/orders',
            //     // 'delete transaction/orders',
            //     // 'read transaction/laporans',
            //     // 'create transaction/laporans',
            //     // 'update transaction/laporans',
            //     // 'delete transaction/laporans',
            // ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
