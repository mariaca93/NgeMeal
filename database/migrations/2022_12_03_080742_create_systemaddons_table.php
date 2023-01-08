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
        Schema::create('systemaddons', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->string('name');
            $table->string('unique_identifier');
            $table->string('version', 20);
            $table->integer('activated');
            $table->string('image');
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
        Schema::dropIfExists('systemaddons');
    }
};
