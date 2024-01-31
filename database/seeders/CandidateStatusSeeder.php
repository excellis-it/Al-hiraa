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
                'name' => 'ACTIVE',
            ],
            [
                'name' => 'IN-ACTIVE',
            ],
            [
                'name' => 'BLACK LIST',
            ],
            [
                'name' => 'SELECTED',
            ],
            [
                'name' => 'BACKED OUT',
            ],
            [
                'name' => 'UNDER MEDICAL',
            ],
            [
                'name' => 'FIT',
            ],
            [
                'name' => 'UNFIT',
            ],
            [
                'name' => 'AWAITING VISA',
            ],
            [
                'name' => 'AWAITING DEPLOYMENT',
            ],
            [
                'name' => 'DEPLOYED',
            ],
        ];

        foreach ($candidateStatuses as $candidateStatus) {
            CandidateStatus::create($candidateStatus);
        }
    }
}
