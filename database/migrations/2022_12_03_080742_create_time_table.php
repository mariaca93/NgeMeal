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
        Schema::create('time', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->string('day', 50);
            $table->string('open_time', 20);
            $table->string('break_start');
            $table->string('break_end');
            $table->string('close_time', 20);
            $table->integer('always_close')->default(2)->comment('1 = Yes , 2 = No');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time');
    }
};
