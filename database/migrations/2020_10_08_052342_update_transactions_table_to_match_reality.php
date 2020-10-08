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
            $table->timestamp('authorization_date')->nullable()->after('iso_currency_code');
            $table->timestamp('completion_date')->nullable()->after('authorization_date');
            $table->longText('location')->after('completion_date');
            $table->string('name')->after('location');
            $table->string('merchant_name')->after('name');
            $table->longText('payment_meta')->after('merchant_name');
            $table->string('payment_channel')->after('payment_meta');
            $table->boolean('pending')->default(true)->after('payment_channel');
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
