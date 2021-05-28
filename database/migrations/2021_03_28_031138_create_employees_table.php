<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('company');
            $table->string('name', 100);
            $table->integer('civil_state')->nullable();
            $table->string('position', 50);
            $table->integer('sex')->nullable();
            $table->string('sector', 50);
            $table->string('vat', 11)->nullable();
            $table->string('personal_id', 14)->nullable();
            $table->string('phone_number_1', 20)->nullable();
            $table->string('phone_number_2', 20)->nullable();
            $table->date('admission_date')->nullable();
            $table->date('removal_date')->nullable();
            $table->date('resignation_date')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
