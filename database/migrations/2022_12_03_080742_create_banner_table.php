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
        Schema::create('banner', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->integer('item_id')->nullable();
            $table->integer('cuisine_id')->nullable();
            $table->string('type', 10)->nullable()->comment('1=cuisine,2=item');
            $table->string('image');
            $table->integer('is_available')->default(1)->comment('1=yes,2=no');
            $table->integer('section')->default(0)->comment('1=section-,2=section2,3=section3,4=section4');
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
        Schema::dropIfExists('banner');
    }
};
