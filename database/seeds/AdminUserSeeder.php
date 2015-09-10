<?php

use Illuminate\Database\Seeder;
use livepos\User;
use livepos\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('roles')->delete();
        DB::table('role_user')->delete();
        
        
        $roleSuper =Role::create(['name' => 'Super']);
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleManager = Role::create(['name' => 'Manager']);
        $roleStaff = Role::create(['name' => 'Staff', 'forbidden' => ['User.show']]);
        
        User::create([
            'name' => 'Livepos Assistant',
            'username' => 'livepos',
            'email' => 'hiretweb+livepos@gmail.com',
            'password' => bcrypt(livepos_password('12345')),
        ])->assignRole($roleSuper);
        
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'hiretweb+liveposAdmin@gmail.com',
            'password' => bcrypt(livepos_password('12345')),
        ])->assignRole($roleAdmin);
        
        User::create([
            'name' => 'Manager',
            'username' => 'manager',
            'email' => 'hiretweb+liveposManager@gmail.com',
            'password' => bcrypt(livepos_password('12345')),
        ])->assignRole($roleManager);
        
        User::create([
            'name' => 'Staff',
            'username' => 'staff',
            'email' => 'hiretweb+liveposStaff@gmail.com',
            'password' => bcrypt(livepos_password('12345')),
        ])->assignRole($roleStaff);
   
    }
}
