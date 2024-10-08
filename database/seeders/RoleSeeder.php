<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'ADMIN']);
        $recruiterRole = Role::create(['name' => 'RECRUITER']);
        $processManagerRole = Role::create(['name' => 'PROCESS MANAGER']);
        $dataEntryOperatorRole = Role::create(['name' => 'DATA ENTRY OPERATOR']);
        $associateRole = Role::create(['name' => 'ASSOCIATE']);
        $associateRole = Role::create(['name' => 'VENDOR']);
        $referPartnerRole = Role::create(['name' => 'REFERRAL PARTNER']);
        // $adminRole->givePermissionTo('all');
    }
}
