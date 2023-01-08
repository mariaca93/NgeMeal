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
        Schema::create('about', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->integer('maintenance_mode')->default(2)->comment('1=yes,2=no');
            $table->longText('about_content')->nullable();
            $table->text('fb')->nullable();
            $table->text('youtube')->nullable();
            $table->text('insta')->nullable();
            $table->text('android')->nullable();
            $table->text('ios')->nullable();
            $table->text('app_bottom_image')->nullable();
            $table->string('mobile_app_image')->nullable();
            $table->text('mobile_app_title')->nullable();
            $table->text('mobile_app_description')->nullable();
            $table->text('copyright')->nullable();
            $table->string('title')->nullable();
            $table->string('short_title', 20)->nullable();
            $table->text('og_title')->nullable();
            $table->longText('og_description')->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('email', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('currency', 11)->nullable();
            $table->integer('currency_position')->nullable()->comment('1=left,2=right
');
            $table->integer('max_order_qty');
            $table->integer('min_order_amount');
            $table->integer('max_order_amount');
            $table->double('delivery_charge');
            $table->text('map');
            $table->text('firebase');
            $table->integer('referral_amount');
            $table->text('timezone')->nullable();
            $table->text('lat');
            $table->text('lang');
            $table->string('image', 50)->nullable()->comment('about-image');
            $table->string('logo')->nullable();
            $table->string('footer_title')->nullable();
            $table->string('footer_description')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('footer_bg_image')->nullable();
            $table->string('favicon')->nullable();
            $table->string('og_image')->nullable();
            $table->string('auth_bg_image')->nullable();
            $table->string('breadcrumb_bg_image')->nullable();
            $table->string('booknow_bg_image');
            $table->string('reviews_bg_image');
            $table->string('mobile_app_bg_image')->nullable();
            $table->string('verification', 50)->nullable();
            $table->string('current_version');
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
        Schema::dropIfExists('about');
    }
};
