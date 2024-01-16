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
                'name' => 'Passive',
            ],
            [
                'name' => 'Blacklisted',
            ],
            [
                'name' => 'Selected',
            ],
            [
                'name' => 'Under Medical',
            ],
            [
                'name' => 'Awaiting Fitness',
            ],
            [
                'name' => 'Fit',
            ],
            [
                'name' => 'Awaiting Visa',
            ],
            [
                'name' => 'Deployed',
            ],
            [
                'name' => 'Unfit',
            ]
        ];

        foreach ($candidateStatuses as $candidateStatus) {
            CandidateStatus::create($candidateStatus);
        }
    }
}
