<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReferCms;

class ReferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        ReferCms::truncate();

        $refer_cms = new ReferCms();
        $refer_cms->main_title = 'REFERRAL OFFER';
        $refer_cms->small_description = 'lorem ipsum is simply dummy text of the printing and typesetting industry.';
        $refer_cms->small_description2 = 'Get your Rewards in three simple steps';
        $refer_cms->image = 'refers/refer_main_img.png';
        $refer_cms->content1_title = 'Candidates referred';
        $refer_cms->content1_description = 'lorem ipsum is simply dummy text of the printing and typesetting industry.';
        $refer_cms->content1_image = 'refers/icon1.svg';
        $refer_cms->content2_title = 'Successfully deployed';
        $refer_cms->content2_description = 'lorem ipsum is simply dummy text of the printing and typesetting industry.';
        $refer_cms->content2_image = 'refers/icon2.svg';
        $refer_cms->content3_title = 'Submit UPI Details- Gpay | PhonePay';
        $refer_cms->content3_description = 'lorem ipsum is simply dummy text of the printing and typesetting industry.';
        $refer_cms->content3_image = 'refers/icon3.svg';
        $refer_cms->save();
    }
}
