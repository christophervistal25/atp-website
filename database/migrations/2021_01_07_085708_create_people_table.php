<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('person_id')->unique();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('suffix', 3)->nullable();
            $table->date('date_of_birth');
            $table->string('province_code');
            $table->string('city_code');
            $table->string('barangay_code');
            $table->enum('gender', ['male', 'female']);
            $table->text('temporary_address');
            $table->text('address');
            $table->integer('age');
            $table->string('civil_status');
            $table->string('phone_number');
            $table->string('landline_number')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->default('default.png');
            $table->enum('registered_from', ['MOBILE', 'WEBSITE'])->default('WEBSITE');
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
        Schema::dropIfExists('people');
    }
}
