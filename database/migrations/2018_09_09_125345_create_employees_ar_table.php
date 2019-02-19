<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesArTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_ar', function (Blueprint $table) {
            $table->increments('e_id');
            $table->string('e_fname');
            $table->string('e_lname');
            $table->string('e_email')->nullable($value = true);
            $table->string('e_phone')->nullable($value = true);
            $table->bigInteger('company_id');
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
        Schema::dropIfExists('subadmins_ar');
    }
}
