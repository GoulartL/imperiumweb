<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('company');
            $table->integer('type')->nullable();
            $table->string('taxvat', 14)->nullable();
            $table->string('state_register_id', 14)->nullable();
            $table->string('name', 100);
            $table->string('fantasy_name', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->integer('number')->nullable();
            $table->string('district', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 2)->nullable();
            $table->string('complement', 100)->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('contact_name', 100)->nullable();
            $table->string('phone_number_1', 20)->nullable();
            $table->string('phone_number_2', 20)->nullable();
            $table->string('email_1', 100)->nullable();
            $table->string('email_2', 100)->nullable();
            $table->string('bank', 50)->nullable();
            $table->integer('agency')->nullable();
            $table->integer('account')->nullable();
            $table->string('account_name', 100)->nullable();
            $table->text('observation')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
