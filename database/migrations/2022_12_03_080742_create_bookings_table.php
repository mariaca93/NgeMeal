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
        Schema::create('bookings', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('mobile');
            $table->integer('guests');
            $table->string('date');
            $table->string('time');
            $table->string('reservation_type');
            $table->string('special_request')->nullable();
            $table->integer('status')->comment('1=pending,2=accepted,3=rejected');
            $table->integer('table_number')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
