<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('mtn_external_id');
            $table->string('status');
            $table->string('party_id_type');
            $table->string('phone_number');
            $table->string('currency');
            $table->bigInteger('amount');
            $table->string('payer_message');
            $table->string('payee_note');
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
        Schema::dropIfExists('transactions');
    }
}
