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
        Schema::create('subcuisines', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->integer('cuisine_id')->comment('cuisine id from cuisine table');
            $table->string('subcuisine_name');
            $table->text('slug');
            $table->boolean('is_available')->default(true)->comment('1=yes,2=no');
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
        Schema::dropIfExists('subcuisines');
    }
};
