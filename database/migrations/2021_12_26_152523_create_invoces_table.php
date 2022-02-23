<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvocesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoces', function (Blueprint $table) {
            $table->id();
            $table->string('invoces_number')->unique();
            $table->date('invoces_data');
            $table->date('due_data');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete("cascade");
            $table->unsignedBigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete("cascade");
            $table->decimal('price_collection',8,2);
            $table->decimal('Price_Commission',8,2);
            $table->string('discount');
            $table->string('rote_vat');
            $table->decimal('value_vat',8,2);
            $table->decimal('total',8,2);
            $table->string('status',50);
            $table->integer('values_status');
            $table->text('note')->nullable();
            $table->string('user');
            $table->softDeletes();
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
        Schema::dropIfExists('invoces');
    }
}
