<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Spatie\Permission\PermissionRegistrar;

class UsersTableSeeder extends Seeder
{
    /**

     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nick' => 'Mike5',
            'nombre'      => 'El',
            'apellidos'      => 'Zorro',
            'email'     => 'maguerri@deloitte4.es',
            'password'     => bcrypt('123'),

        ]);

        //CREAMOS PERMISOS
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'news.index']);
        Permission::create(['name' => 'news.edit']);
        Permission::create(['name' => 'news.show']);
        Permission::create(['name' => 'news.create']);
        Permission::create(['name' => 'news.destroy']);

        //CREAMOS ROL Y ASIGNAMOS PERMISOS
        $role = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Usuario']);

        $role->givePermissionTo('news.index');
        $role->givePermissionTo('news.edit');
        $role->givePermissionTo('news.show');
        $role->givePermissionTo('news.create');
        $role->givePermissionTo('news.destroy');

        $role2->givePermissionTo('news.index');
        $role2->givePermissionTo('news.edit');
        $role2->givePermissionTo('news.show');
        $role2->givePermissionTo('news.create');
        $role2->givePermissionTo('news.destroy');

       
        $user->assignRole($role);
        $user->assignRole($role2);
    }
}
