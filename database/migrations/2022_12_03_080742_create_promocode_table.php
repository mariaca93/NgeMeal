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
        Schema::create('promocode', function (Blueprint $table) {
            $table->comment('');
            $table->bigInteger('id', true);
            $table->string('offer_name');
            $table->string('offer_code', 20);
            $table->integer('offer_type')->comment('1=fixed,2=percentage');
            $table->string('offer_amount');
            $table->integer('min_amount');
            $table->integer('per_user');
            $table->integer('usage_type')->comment('1=One time,2=multiple times');
            $table->text('start_date');
            $table->text('expire_date');
            $table->longText('description');
            $table->integer('is_available')->default(1)->comment('1 = Yes , 2 = No');
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
        Schema::dropIfExists('promocode');
    }
};
