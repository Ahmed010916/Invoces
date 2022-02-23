<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name'=>'Invoces'],
            ['name'=>'Invoces_create' ],
            ['name'=>'Invoces_paid' ],
            ['name'=>'Invoces_Unpaid' ],
            ['name'=>'Invoces_part_paid'],
            ['name'=>'Invoces_trached'],
            ['name'=>'delete_invoces' ],
            ['name'=>'edite_invoces' ],
            ['name'=>'export_invoces' ],
            ['name'=>'Reports' ],
            ['name'=>'ReportsInvoces' ],
            ['name'=>'ReportsUsers' ],
            ['name'=>'Users'],
            ['name'=>'Users_create'],
            ['name'=>'Users_edite'],
            ['name'=>'Users_delete'],
            ['name'=>'Roles'],
            ['name'=>'Roles_create'],
            ['name'=>'Roles_edite'],
            ['name'=>'Roles_delete'],
            ['name'=>'Settings'],
            ['name'=>'Sections'],
            ['name'=>'Section_create'],
            ['name'=>'Section_edite'],
            ['name'=>'Section_delete'],
            ['name'=>'Product'],
            ['name'=>'Product_create'],
            ['name'=>'Product_edite'],
            ['name'=>'Product_delete'],
        ];

        foreach ($permissions as $permission => $value) {

            $permission = Permission::create([
                'name'=>$value['name'],
                'display_name' =>$value['name'],
                'description'=> $value['name'],
            ]);

            Role::find(1)->attachPermission($permission);
        }
        Role::find(2)->attachPermissions(['Invoces','Invoces_create','Invoces_paid','Invoces_Unpaid',
        'Invoces_part_paid','export_invoces','Reports','ReportsInvoces','ReportsUsers','Settings','Sections','Section_create','Product','Product_create']);
    }
}
