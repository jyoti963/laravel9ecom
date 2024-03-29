<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords =[
            ['id'=>1,'name'=>'Jyoti','type'=>'admin','vendor_id'=>'','image'=>'','mobile'=>'6386739674','email'=>'admin@admin.com','password'=>'$2a$12$of988VbQv5KmMN2OwL2jxen6S7lpihzFfrB/d6PkFxPD6SsTIL6Fm','status'=>1],
        ];
        Admin::insert($adminRecords);
    }
}
