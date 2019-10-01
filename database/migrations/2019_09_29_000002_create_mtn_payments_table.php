
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMtnPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtn_payments', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedInteger('donation_id');
            $table->enum('status', ['PENDING', 'FAILED','REJECTED','TIMEOUT','ONGOING','SUCCESSFUL']);
            $table->string('reason')->nullable();
            $table->enum('party_id_type', ['MSISDN', 'EMAIL', 'ID'])->default('MSISDN');
            $table->string('party_id', 50);
            $table->char('currency', 3);
            $table->float('amount');
            $table->string('payer_message');
            $table->string('payee_note');
            $table->timestamps();

            $table->primary('id');

            $table->foreign('donation_id')->references('id')->on('donations')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mtn_payments', function (Blueprint $table) {
            $table->dropForeign(['donation_id']);
        });

        Schema::dropIfExists('mtn_payments');
    }
}
