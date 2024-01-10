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
                'name' => 'Inactive',
            ],
            [
                'name' => 'Accepted',
            ],
            [
                'name' => 'Medical',
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
