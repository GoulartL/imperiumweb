<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->integer('company');
            $table->string('description');
            $table->integer('client');
            $table->date('emission');
            $table->integer('portion');
            $table->date('due_date');
            $table->float('value');
            $table->date('receipt_date')->nullable();
            $table->float('receipt_value')->nullable();
            $table->integer('species');
            $table->string('observation')->nullable();
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
        Schema::dropIfExists('receipts');
    }
}
