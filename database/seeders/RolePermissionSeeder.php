<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrPermissions = [
            [
                "name" => "Manage Profile",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Candidate",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Candidate",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "View Candidate",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Candidate",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Export Candidate",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Job",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Job",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Job",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Company",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Company",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "View Company",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Company",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Schedule",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Schedule",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Schedule",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Schedule",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage New Registration",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Revenue",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Team Performance",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Resignation",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Team",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Team",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Team",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Team",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage User Access",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create User Access",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit User Access",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete User Access",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Support",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Manage Position",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Create Position",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Edit Position",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],
            [
                "name" => "Delete Position",
                "guard_name" => "web",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ],

        ];
        Permission::insert($arrPermissions);

        $adminRole = Role::where('name', 'ADMIN')->first();
        $adminPermissions = [
            "Manage Profile",
            "Manage Candidate",
            "Create Candidate",
            "View Candidate",
            "Edit Candidate",
            "Export Candidate",
            "Manage Job",
            "Create Job",
            "Edit Job",
            "Manage Company",
            "Create Company",
            "View Company",
            "Edit Company",
            "Manage Schedule",
            "Create Schedule",
            "Delete Schedule",
            "Edit Schedule",
            "Manage New Registration",
            "Manage Revenue",
            "Manage Team Performance",
            "Delete Resignation",
            "Manage Team",
            "Create Team",
            "Edit Team",
            "Delete Team",
            "Manage User Access",
            "Create User Access",
            "Edit User Access",
            "Delete User Access",
            "Manage Support",
            "Manage Position",
            "Create Position",
            "Edit Position",
            "Delete Position",
        ];

        $adminRole->givePermissionTo($adminPermissions);


        $dataEntryOperatorRole = Role::where('name', 'DATA ENTRY OPERATOR')->first();
        $dataEntryOperatorPermissions = [
            "Manage Candidate",
            "Create Candidate",
            "View Candidate",
            "Manage Support",
        ];

        $dataEntryOperatorRole->givePermissionTo($dataEntryOperatorPermissions);

        $recruiterRole = Role::where('name', 'RECRUITER')->first();
        $recruiterPermissions = [
            "Manage Candidate",
            "Create Candidate",
            "Edit Candidate",
            "View Candidate",
            "Manage Support",
        ];

        $recruiterRole->givePermissionTo($recruiterPermissions);

        $processManagerRole = Role::where('name', 'PROCESS MANAGER')->first();
        $processManagerPermissions = [
            "Manage Candidate",
            "Create Candidate",
            "View Candidate",
            "Edit Candidate",
            "Manage Job",
            "Create Job",
            "Edit Job",
            "Manage Support",
        ];

        $processManagerRole->givePermissionTo($processManagerPermissions);

        $associateRole = Role::where('name', 'ASSOCIATE')->first();
        $associatePermissions = [
            "Manage Support",
        ];

        $associateRole->givePermissionTo($associatePermissions);

     /*-------------------------------For one permission----------------------------------------------*/
        // $arrPermissions = [
        //     [
        //         "name" => "View Company",
        //         "guard_name" => "web",
        //         "created_at" => now(),
        //         "updated_at" => now(),
        //     ],
        // ];

        // // Insert permission into the database
        // DB::table('permissions')->insert($arrPermissions);

        // $adminRole = Role::where('name', 'ADMIN')->first();

        // // Retrieve the permission by name
        // $viewCompanyPermission = Permission::where('name', 'View Company')->first();

        // // Assign the permission to the role
        // $adminRole->givePermissionTo($viewCompanyPermission);
    }
}
