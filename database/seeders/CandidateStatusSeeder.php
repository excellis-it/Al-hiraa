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
        // truncate the table
        CandidateStatus::truncate();
        $candidateStatuses = [
            [
                'name' => 'ACTIVE',
                'color' => '#11AF65',
                'background' => '#E6FFE9',      
            ],
            [
                'name' => 'IN-ACTIVE',
                'color' => '#E84B4B',
                'background' => '#FFECEC',
            ],
            [
                'name' => 'BLACK LIST',
                'color' => '#654321',
                'background' => '#FCF3E7',
            ],
            [
                'name' => 'SELECTED',
                'color' => '#2196F3',
                'background' => '#E3F2FD',

            ],
            [
                'name' => 'BACKED OUT',
                'color' => '#FFC107',
                'background' => '#FFF9C4',
            ],
            [
                'name' => 'UNDER MEDICAL',
                'color' => '#FF9800',
                'background' => '#FFF9C4',
            ],
            [
                'name' => 'FIT',
                'color' => '#4CAF50',
                'background' => '#ffffff',
            ],
            [
                'name' => 'UNFIT',
                'color' => '#E53935',
                'background' => '#ffffff',
            ],
            [
                'name' => 'AWAITING VISA',
                'color' => '#045c85',
                'background' => '#ffffff',
            ],
            [
                'name' => 'AWAITING DEPLOYMENT',
                'color' => '#00BCD4',
                'background' => '#ffffff',
            ],
            [
                'name' => 'DEPLOYED',
                'color' => '#11AF65',
                'background' => '#E6FFE9',
            ],
        ];

        foreach ($candidateStatuses as $candidateStatus) {
            CandidateStatus::create($candidateStatus);
        }
    }
}
