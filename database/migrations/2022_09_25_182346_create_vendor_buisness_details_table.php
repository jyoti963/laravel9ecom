<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_buisness_details', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->string('shop_name')->nullable();
            $table->string('shop_address')->nullable();
            $table->string('shop_city')->nullable();
            $table->string('shop_state')->nullable();
            $table->string('shop_country')->nullable();
            $table->string('shop_pincode')->nullable();
            $table->string('shop_email')->nullable();
            $table->string('shop_mobile')->nullable();
            $table->string('shop_website')->nullable();
            $table->string('address_proof')->nullable();
            $table->string('address_proof_image')->nullable();
            $table->string('buisness_lincence_no')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('pancard_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor_buisness_details');
    }
};
