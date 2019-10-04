<?php
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder

{
    public function run()

    {

        DB::table('permissions')->delete();
        DB::table('permissions')->insert([

              ['name' => 'manage_people','description' => 'Manage People'],
              ['name' => 'manage_visitor', 'description' => 'Manage Visitor'],
              ['name' => 'manage_driver','description' => 'Manage Driver'],

              ['name' => 'manage_user', 'description' => 'Manage user'],
              ['name' => 'add_user','description' => 'Add user'],
              ['name' => 'edit_user', 'description' => 'Edit user'],
              ['name' => 'delete_user', 'description' => 'Delete user'],


              ['name' => 'manage_role', 'description' => 'Manage role'],
              ['name' => 'add_role','description' => 'Add role'],
              ['name' => 'edit_role', 'description' => 'Edit role'],
              ['name' => 'delete_role', 'description' => 'Delete role'],

              ['name' => 'manage_setting', 'description' => 'Manage Setting'],

        ]);

    }

}

