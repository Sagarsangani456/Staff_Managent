<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()['cache']->forget('spatie.permission.cache');

        $arraypermission = [
            'role-manage',
            'role-create',
            'role-edit',
            'role-delete',
            'user-manage',
            'user-create',
            'user-edit',
            'user-delete',
            'contact-manage',
            'contact-create',
            'contact-edit',
            'contact-delete',
            'support-manage',
            'support-create',
            'support-edit',
            'support-delete',
            'support-reply',
            'note-manage',
            'note-create',
            'account-manage',
            'password-manage',
            'general-manage',
            'company-manage',
            'email-manage',
            'payment-manage',
            'coupon-manage',
            'coupon-create',
            'coupon-edit',
            'coupon-delete',
            'plan-manage',
            'plan-create',
            'plan-edit',
            'plan-delete',
        ];

        foreach($arraypermission as $arraypermission_list)
        {
            $group_name = strtok($arraypermission_list, '-');

            Permission::create([
                                   'group' => $group_name,
                                   'name' => $arraypermission_list,
                               ]);
        }


        $superadminrole = Role::create(
            [
                'name' => 'super admin',
            ]
        );

        $superadminPermissions = [

//             'role-manage',
//             'role-create',
//             'role-edit',
//             'role-delete',
//             'user-manage',
//             'user-create',
//             'user-edit',
//             'user-delete',
//             'contact-manage',
//             'contact-create',
//             'contact-edit',
//             'contact-delete',
//             'support-manage',
//             'support-create',
//             'support-edit',
//             'support-delete',
//             'support-reply',
//             'note-manage',
//             'note-create',
             'account-manage',
             'password-manage',
             'general-manage',
             'company-manage',
             'email-manage',
             'payment-manage',
             'coupon-manage',
             'coupon-create',
             'coupon-edit',
             'coupon-delete',
             'plan-manage',
             'plan-create',
             'plan-edit',
             'plan-delete',
        ];

        foreach($superadminPermissions as $superadminPermissions_list)
        {
            $permission = Permission::findByName($superadminPermissions_list);
            $superadminrole->givePermissionTo($permission);
        }

        $superadmin = User::create([
                                  'name' => 'sagar',
                                  'email' => 'sagar123@gmail.com',
                                  'password' => Hash::make('12345678'),
                                  'created_by' => 0,
                                  'type'=>'super admin',
                                  'image'=>'1696401323user.png'
                              ]);
        $superadmin->assignRole($superadminrole);

    }
}


