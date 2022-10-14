<?php

namespace Database\Seeders;

use App\Models\VendorBankDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorBankDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorBankRecords =[
            ['id'=>1,'vendor_id'=>'1','account_holder_name'=>'Juhi','bank_name'=>'Punjab National Bank','bank_ifsc_code'=>'PUNB0191400','bank_account_no'=>'123456709876542345'],
        ];
        VendorBankDetail::insert($vendorBankRecords);
    }
}
