<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvocesAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoces_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('invoces_numper');
            $table->unsignedBigInteger('invoces_id');
            $table->foreign('invoces_id')->references('id')
                ->on('invoces')->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_path')->nullable();
            $table->string('file_type')->nullable();
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
        Schema::dropIfExists('invoces_attachments');
    }
}
