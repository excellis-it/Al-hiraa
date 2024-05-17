<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->delete();
        $states = array(
            array('name' => "Andaman and Nicobar Islands"),
            array('name' => "Andhra Pradesh"),
            array('name' => "Arunachal Pradesh"),
            array('name' => "Assam"),
            array('name' => "Bihar"),
            array('name' => "Chandigarh"),
            array('name' => "Chhattisgarh"),
            array('name' => "Dadra and Nagar Haveli"),
            array('name' => "Daman and Diu"),
            array('name' => "Delhi"),
            array('name' => "Goa"),
            array('name' => "Gujarat"),
            array('name' => "Haryana"),
            array('name' => "Himachal Pradesh"),
            array('name' => "Jammu and Kashmir"),
            array('name' => "Jharkhand"),
            array('name' => "Karnataka"),
            array('name' => "Kenmore"),
            array('name' => "Kerala"),
            array('name' => "Lakshadweep"),
            array('name' => "Madhya Pradesh"),
            array('name' => "Maharashtra"),
            array('name' => "Manipur"),
            array('name' => "Meghalaya"),
            array('name' => "Mizoram"),
            array('name' => "Nagaland"),
            array('name' => "Narora"),
            array('name' => "Natwar"),
            array('name' => "Odisha"),
            array('name' => "Paschim Medinipur"),
            array('name' => "Pondicherry"),
            array('name' => "Punjab"),
            array('name' => "Rajasthan"),
            array('name' => "Sikkim"),
            array('name' => "Tamil Nadu"),
            array('name' => "Telangana"),
            array('name' => "Tripura"),
            array('name' => "Uttar Pradesh"),
            array('name' => "Uttarakhand"),
            array('name' => "Vaishali"),
            array('name' => "West Bengal"),
            );

        foreach ($states as $state) {
            State::create($state);
        }
    }
}
