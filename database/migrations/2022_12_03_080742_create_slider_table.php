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
        Schema::create('slider', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->string('title', 50);
            $table->integer('type')->nullable();
            $table->integer('cuisine_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->text('description')->nullable();
            $table->string('image', 50);
            $table->integer('is_available')->default(1)->comment('1=yes,2=no
');
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
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
        Schema::dropIfExists('slider');
    }
};
