<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list'  => 'role|Role List',
           'role-create'=> 'role|Role Create',
           'role-edit'  => 'role|Role Edit',
           'role-delete'=> 'role|Role Delete',
           'user-list'  => 'user|User List',
           'user-create'=> 'user|User Create',
           'user-edit'  => 'user|User Edit',
           'user-delete'=> 'user|User Delete',
        ];
     
        foreach ($permissions as $permission=> $group_name) {
            $arr = explode("|", $group_name);
             Permission::create([   
                                'name' => $permission, 
                                'group_name'=> $arr[0], 
                                'event_name'=> (isset($arr[1]) ? $arr[1] : '' )
                            ]);
        }
    }
}


// $ php artisan db:seed --class=PermissionTableSeeder


