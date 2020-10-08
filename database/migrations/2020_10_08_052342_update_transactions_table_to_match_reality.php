<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTransactionsTableToMatchReality extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('iso_currency_code')->after('amount');
            $table->timestamp('authorization_date')->nullable();
            $table->timestamp('completion_date')->nullable();
            $table->longText('location');
            $table->string('name');
            $table->string('merchant_name');
            $table->longText('payment_meta');
            $table->string('payment_channel');
            $table->boolean('pending')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn([
                'iso_currency_code',
                'authorization_date',
                'completion_date',
                'location',
                'name',
                'merchant_name',
                'payment_meta',
                'payment_channel',
                'pending'
            ]);
        });
    }
}
