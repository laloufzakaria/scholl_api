<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnes', function (Blueprint $table) {
            $table->id();
            $table->string('admission_no');
            $table->timestamp('admission_date')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('mobileno');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->string('religion');
            $table->timestamp('dob')->nullable();;
            $table->string('gender');
            $table->string('current_address');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('class_id')->constrained('classes');
            $table->string('is_active')->default('yes');
            $table->rememberToken();
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
        Schema::dropIfExists('personnes');
    }
}
