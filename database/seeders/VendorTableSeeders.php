<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords =[
            ['id'=>1,'name'=>'juhi','address'=>'68S Shivpur','city'=>'Gorakhpur','state'=>'Uttar Pradesh','country'=>'India','pincode'=>'273008','mobile'=>'6386739674','email'=>'juhi@test.com','status'=>0],
        ];
        Vendor::insert($vendorRecords);
    }
}
