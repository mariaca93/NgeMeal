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
        Schema::create('pincode', function (Blueprint $table) {
            $table->comment('');
            $table->bigInteger('id', true);
            $table->string('pincode', 10);
            $table->string('delivery_charge');
            $table->integer('is_available')->default(1)->comment('1=yes,2=no');
            $table->integer('is_deleted')->default(2)->comment('1=yes,2=no');
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
        Schema::dropIfExists('pincode');
    }
};
