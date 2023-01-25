<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            // for customers and employees
            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->string('postal_code');
            // optional for customer
            $table->string('address');
            $table->string('city');
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            // customer email is created in the user table
            // employee email is created in the user table
            // personal email is for employees only
            $table->string('personal_email')->nullable();
            $table->string('burger_service_nummer')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('persons');
    }
};
