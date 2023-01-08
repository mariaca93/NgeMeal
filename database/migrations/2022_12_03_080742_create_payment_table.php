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
        Schema::create('payment', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->integer('environment')->default(1)->comment('1=sandbox,2=production');
            $table->text('payment_name');
            $table->string('image')->nullable();
            $table->string('currency');
            $table->text('public_key');
            $table->text('secret_key');
            $table->text('encryption_key');
            $table->integer('is_available');
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
        Schema::dropIfExists('payment');
    }
};
