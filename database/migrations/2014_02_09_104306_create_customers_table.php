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
        Schema::dropIfExists('customers');
        Schema::create('customers', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->string('name');
            $table->string('email',191)->unique();
            $table->string('password');
            $table->rememberToken();


            $table->string('phone',15)->nullable();
            $table->string('s_street',50)->nullable();
            $table->string('s_city',50)->nullable();
            $table->string('s_state',50)->nullable();
            $table->string('s_zipcode',50)->nullable();
            $table->integer('s_country_id')->unsigned()->index()->nullable();
            $table->foreign('s_country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');

            $table->string('b_street',50)->nullable();
            $table->string('b_city',50)->nullable();
            $table->string('b_state',50)->nullable();
            $table->string('b_zipcode',50)->nullable();

            $table->integer('b_country_id')->unsigned()->index()->nullable();
            $table->foreign('b_country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');

            $table->enum('status',['active', 'inactive'])->default('active');

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
