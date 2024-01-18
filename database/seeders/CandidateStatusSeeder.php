<?php

namespace Database\Seeders;

use App\Models\CandidateStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $candidateStatuses = [
            [
                'name' => 'Active',
            ],
            [
                'name' => 'In-Active',
            ],
            [
                'name' => 'Black List',
            ],
            [
                'name' => 'Selected',
            ],
            [
                'name' => 'Backed Out',
            ],
            [
                'name' => 'Under Medical',
            ],
            [
                'name' => 'Fit',
            ],
            [
                'name' => 'Unfit',
            ],
            [
                'name' => 'Awaiting Visa',
            ],
            [
                'name' => 'Awaiting Deployment',
            ],
            [
                'name' => 'Deployed',
            ],
        ];

        foreach ($candidateStatuses as $candidateStatus) {
            CandidateStatus::create($candidateStatus);
        }
    }
}
