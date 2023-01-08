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
        Schema::create('address', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('address_type')->comment('(1- Home, 2-Office, 3-Other)');
            $table->text('address');
            $table->string('lat');
            $table->string('lang');
            $table->string('area')->nullable();
            $table->string('house_no');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
};
