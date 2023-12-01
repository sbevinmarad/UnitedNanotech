<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->text('header_text')->nullable();
            $table->text('footer_text')->nullable();
            $table->text('address')->nullable();
            $table->text('address_2')->nullable();
            $table->string('email')->nullable();
            $table->string('email_2')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_2')->nullable();
            $table->text('paypal_client_id')->nullable();
            $table->text('paypal_client_secret')->nullable();
            $table->text('stripe_key')->nullable();
            $table->text('stripe_secret')->nullable();
            $table->enum('payment_mode', ['Sandbox', 'Live'])->nullable();
            $table->text('razor_pay_key')->nullable();
            $table->text('razor_pay_secret')->nullable();
            $table->text('google_recaptcha_key')->nullable();
            $table->text('google_recaptcha_secret')->nullable();
            $table->float('shipping_charge',8, 2)->nullable();
            $table->text('map')->nullable();
            $table->string('opening_hour')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
