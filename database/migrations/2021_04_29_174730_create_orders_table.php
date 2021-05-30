<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('company');
            $table->string('code');
            $table->integer('customer');
            $table->date('entry_date');
            $table->string('incoming_invoice')->nullable();
            $table->string('ref')->nullable();
            $table->string('model')->nullable();
            $table->string('collection')->nullable();
            $table->float('qty');
            $table->float('price');

            $table->integer('sector');

            $table->date('cancellation_date')->nullable();
            $table->string('cancellation_reason')->nullable();

            $table->date('delivery_date_sewing')->nullable();
            $table->date('expected_date_sewing')->nullable();
            $table->date('departure_date_sewing')->nullable();

            $table->date('delivery_date_finishing')->nullable();
            $table->date('expected_date_finishing')->nullable();
            $table->date('departure_date_finishing')->nullable();

            $table->date('entry_date_expedition')->nullable();
            $table->string('outgoing_invoice')->nullable();
            $table->date('expected_date_expedition')->nullable();
            $table->date('departure_date_expedition')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
