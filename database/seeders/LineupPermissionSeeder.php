<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LineupPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Standard naming to match the permissions grid
        $permissions = [
            'Manage Lineup',
            'Edit Lineup',
            'View Lineup',
            'Export Lineup'
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        // Assign to Admin
        $adminRole = Role::where('name', 'ADMIN')->first();
        if ($adminRole) {
            $adminRole->givePermissionTo($permissions);
        }

        // Assign to Recruiter
        $recruiterRole = Role::where('name', 'RECRUITER')->first();
        if ($recruiterRole) {
            $recruiterRole->givePermissionTo($permissions);
        }

        $rolesToAssign = ['OPERATION MANAGER', 'PROCESS MANAGER', 'DATA ENTRY OPERATOR'];
        foreach ($rolesToAssign as $roleName) {
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $role->givePermissionTo($permissions);
            }
        }
    }
}
