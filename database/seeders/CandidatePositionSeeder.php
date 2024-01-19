<?php

namespace Database\Seeders;

use App\Models\CandidatePosition;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidatePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $position_name = [
            1 => 'AC TECHNICIAN SPLIT & WINDOW',
            2 => 'ACCOUNTANT',
            3 => 'ALUMINIUM FABRICATOR',
            4 => 'ANIMAL WARDEN',
            5 => 'ANY HELPER',
            6 => 'ARABIC CHEF',
            7 => 'AREA RESTAURANT MANAGER',
            8 => 'ASST. ELECTRICIAN',
            9 => 'ASST. COOK',
            10 => 'ASST. PLUMBER',
            11 => 'ASST. RESTAURANT MANAGER',
            12 => 'ASST. SUPERVISOR',
            13 => 'ASST. WAITER',
            14 => 'AUTO AC TECHNICIAN',
            15 => 'AUTO ELECTRICIAN',
            16 => 'AUTO MOBILE ENG',
            17 => 'AUTO MOBILE TECHNICIAN',
            18 => 'AUTO CAD',
            19 => 'CDP',
            20 => 'CHEF',
            21 => 'D-CDP',
            22 => 'BAKERY & PASTRY MAN',
            23 => 'SOUS CHEF',
            24 => 'BAKERY MAN',
            25 => 'MANAGER',
            26 => 'BANQUET SUPERVISOR',
            27 => 'BARTENDER',
            28 => 'BARBER FEMALE',
            29 => 'BARBER MALE',
            30 => 'BARISTA',
            31 => 'BELL BOY',
            32 => 'BIKE MECHANIC',
            33 => 'BOILER OPERATOR',
            34 => 'BOUNCER',
            35 => 'BULLDOZER OPERATOR',
            36 => 'BUSSER',
            37 => 'BUTCHER',
            38 => 'BUTCHER & SLAUGHTERER',
            39 => 'BUTCHER MACHINE CUTTER',
            40 => 'CABLE JOINTER',
            41 => 'CAMP BOSS',
            42 => 'CAPTAIN',
            43 => 'CASHIER',
            44 => 'CATERING SUPERVISOR',
            45 => 'CDP',
            46 => 'CHAPATI MAKER',
            47 => 'CHARTERED ACCOUNTANT',
            48 => 'CIVIL ENGG',
            49 => 'CIVIL FOREMAN',
            50 => 'HELPER',
            51 => 'CIVIL SUPERVISOR',
            52 => 'COBBLER',
            53 => 'COLD KITCHEN CHEF',
            54 => 'COMPUTER EMBROIDER',
            55 => 'COMPUTER ENGINEER',
            56 => 'COMPUTER HARDWARE & NETWORKING',
            57 => 'COMPUTER OPERATOR',
            58 => 'COMPUTER TECHNICIAN',
            59 => 'CONTINENTAL CHEF',
            60 => 'CRANE OPERATOR',
            61 => 'DELIVERY BOY',
            62 => 'DENTER',
            63 => 'DIALYSIS MACHINE TECHNICIAN',
            64 => 'DOCTOR',
            65 => 'DOCUMENT CONTROLLER',
            66 => 'DRAFTSMAN CIVIL',
            67 => 'DRAFTSMAN MECHANICAL',
            68 => 'DRAUGHTSMEN',
            69 => 'DUCT ERECTOR',
            70 => 'DUCT FABRICATOR',
            71 => 'DUCT INSULATOR',
            72 => 'DUCTMAN',
            73 => 'ELECTRICAL ENGINEER',
            74 => 'ELECTRICAL SUPERVISOR',
            75 => 'ELECTRICIAN 220',
            76 => 'ELECTRICIAN 220 & 440',
            77 => 'ELECTRICIAN 440',
            78 => 'ELECTRICIAN PANEL BOARD',
            79 => 'ELECTRICAL TECHNICIAN',
            80 => 'EXCAVATOR OPERATOR',
            81 => 'EXECUTIVE CHEF',
            82 => 'F & B SERVICE',
            83 => 'F & B SUPERVISOR',
            84 => 'FEMALE NURSE',
            85 => 'FINISHING CARPENTER',
            86 => 'GARDENER',
            87 => 'WELDER',
            88 => 'COOK',
            89 => 'GENTS TAILOR',
            90 => 'GLASS DESIGNER',
            91 => 'GOLD SMITH',
            92 => 'GRAPHIC DESIGNER',
            93 => 'GYM TRAINER',
            94 => 'HOST',
            95 => 'HOUSEKEEPER',
            96 => 'HOUSEKEEPING SUPERVISOR',
            97 => 'HR',
            98 => 'HR MANAGER',
            99 => 'HV DRIVER',
            100 => 'HVAC CHILLER PLANT',
            101 => 'HVAC FOREMAN',
            102 => 'HVAC TECHNICIAN',
            103 => 'IATA OFFICER',
            104 => 'CHEF',
            105 => 'INSTRUMENT TECHNICIAN',
            106 => 'INTERIOR DESIGNER',
            107 => 'IT ENGINEER',
            108 => 'JCB OPERATOR',
            109 => 'JUICE MAKER',
            110 => 'KITCHEN STEWARD',
            111 => 'LADIES TAILOR',
            112 => 'LAND SURVEYOR',
            113 => 'LAPTOP TECHNICIAN',
            114 =>  'LAUNDRY BOY',
            115 => 'LAUNDRY SUPERVISOR',
            116 => 'LIFT TECHNICIAN',
            117 => 'LMV DRIVER',
            118 => 'LOADING & UNLOADING',
            119 => 'LOGISTIC MANAGER',
            120 => 'LOGISTIC OFFICER',
            121 => 'LOGISTIC SUPERVISOR',
            122 => 'MACHINE EMBROIDER',
            123 => 'MALE NURSE',
            124 => 'MECHANICAL ENGINEER',
            125 => 'HELPER',
            126 => 'MECHANICAL SUPERVISOR',
            127 => 'MERCHANDISER',
            128 => 'MOBILE CRANE OPERATOR',
            129 => 'MOBILE HARDWARE TECHNICIAN',
            130 =>  'MOBILE SOFTWARE TECHNICIAN',
            131 => 'MOCKTAIL',
            132 => 'OFFICE BOY',
            133 => 'OFFICE MACHINE OPERATOR',
            134 => 'PACKERS',
            135 => 'PARATHA MAKER',
            136 => 'PEST CONTROL',
            137 => 'LMV MECHANIC PETROL',
            138 => 'LMV MECHANIC DIESEL',
            139 => 'HV MECHANIC PETROL',
            140 => 'HV MECHANIC DIESEL',
            141 => 'PHARMACIST',
            142 => 'PHOTOGRAPHER',
            143 => 'PIPE FITTER',
            144 => 'PIZZA MAKER',
            145 => 'PLUMBER',
            146 => 'POCLAIN OPERATOR',
            147 => 'POP',
            148 => 'QURAAN HAFEEZ',
            149 => 'RCC FITTER',
            150 => 'RECEPTIONIST',
            151 => 'REFRIGERATION TECHNICIAN',
            152 => 'RESTAURANT MANAGER',
            153 => 'RESTAURANT SHIFT MANAGER',
            154 => 'RESTAURANT SUPERVISOR',
            155 => 'RIGGER',
            156 => 'ROOM BOY',
            157 => 'RUNNER',
            158 => 'SAFETY ENGINEER',
            159 => 'SAFETY OFFICER',
            160 => 'SALAD MAKER',
            161 => 'SALES MANAGER',
            162 => 'MANAGER',
            163 => 'SCAFFOLDER',
            164 => 'SCREEN PRINTER',
            165 => 'SECURITY GUARD',
            166 => 'SENIOR WAITER',
            167 => 'SERVICE CREW',
            168 => 'SERVICE QUALITY CONTROLLER',
            169 => 'FOOD QUALITY CONTROLLER',
            170 => 'SHUTTERING CARPENTER',
            171 => 'SOFA MAKER',
            172 => 'SOFTWARE DEVELOPER',
            173 => 'SOUS CHEF',
            174 => 'COOK',
            175 => 'SPRAY PAINTER',
            176 => 'STEEL FABRICATOR',
            177 => 'STEEL FIXER',
            178 => 'STEWARD',
            179 => 'POTTER',
            180 => 'STOREKEEPER',
            181 => 'TEACHER',
            182 => 'TELE CALLER',
            183 => 'CHEF',
            184 => 'MASON',
            185 => 'TIMEKEEPER',
            186 => 'TOWER CRANE OPERATOR',
            187 => 'DRIVER',
            188 => 'TYRE TECHNICIAN',
            189 => 'UTILITY OPERATOR',
            190 => 'WAITER',
            191 => 'WALL PAINTER',
            192 => 'WAREHOUSE MANAGER',
            193 => 'WAREHOUSE SUPERVISOR',
            194 => 'WEB DEVELOPER',
            195 => 'WELDER',
            196 => 'XRAY TECHNICIAN',
        ];

        $admin = User::role('ADMIN')->first();

        foreach ($position_name as $key => $value) {
           $candidate_position = CandidatePosition::create([
                'user_id' => $admin->id,
                'name' => $value,
            ]);
        }
    }
}
