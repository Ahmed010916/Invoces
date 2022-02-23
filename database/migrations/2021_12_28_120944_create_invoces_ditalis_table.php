<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvocesDitalisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoces_ditalis', function (Blueprint $table) {
            $table->id();
            $table->string('invoces_numper');
            $table->unsignedBigInteger('invoces_id');
            $table->foreign('invoces_id')->references('id')
                ->on('invoces')->onDelete('cascade');
            $table->date('Paymentdata');
            $table->string('state');
            $table->string('value_state')->comment('1=>paid,2=>UnPaid,3=>partPaid');
            $table->string('Created_by');
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
        Schema::dropIfExists('invoces_ditalis');
    }
}
