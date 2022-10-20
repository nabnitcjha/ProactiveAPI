<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
         $user = User::where('email','admin@proactive.com')->first();
         if(!$user){
             $user = new User();
         }
         $user->first_name = 'super';
         $user->last_name = 'admin';
         $user->email = 'admin@proactive.com';
         $user->role = 'admin';
         $user->user_status = 1;
         $user->password = bcrypt('proactive@admin123');
         $user->created_at = Carbon::now()->format('Y-m-d H:i:s');
         $user->updated_at = Carbon::now()->format('Y-m-d H:i:s');
         $user->save();
         $user->assignRole('admin');
         $role = Role::findByName('admin');
         $role->givePermissionTo(['create','read','update','delete']);
    }
}
