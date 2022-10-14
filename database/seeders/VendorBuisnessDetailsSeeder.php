<?php

namespace Database\Seeders;

use App\Models\VendorBuisnessDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBuisnessDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorBuisnessRecords =[
            ['id'=>1,'vendor_id'=>'1','shop_name'=>'Juhi Computer Parts','shop_address'=>'First floor Baldev Plaza','shop_city'=>'Gorakhpur','shop_state'=>'Uttar Pradesh','shop_country'=>'India','shop_pincode'=>'273008','shop_mobile'=>'6386739674','shop_email'=>'computerparts@test.com','shop_website'=>'www.juhicomputerparts.com','address_proof'=>'Passport','address_proof_image'=>'test.jpg','buisness_lincence_no'=>'1234555544','gst_no'=>'8855453','pancard_no'=>'775544343435',],
        ];
        VendorBuisnessDetails::insert($vendorBuisnessRecords);
    }
}
