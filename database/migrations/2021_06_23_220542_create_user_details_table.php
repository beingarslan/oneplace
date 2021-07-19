<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('image', 255)->nullable();
            $table->string('full_name', 255)->nullable();
            $table->date('dob')->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->text('address')->nullable();
            $table->string('gender', 255)->default('Male');
            $table->string('ssc_degree', 255)->nullable();
            $table->string('ssc_board', 255)->nullable();
            $table->string('ssc_institue', 255)->nullable();
            $table->string('ssc_passing_year', 255)->nullable();
            $table->string('ssc_roll_number', 255)->nullable();
            $table->string('ssc_obt_marks', 255)->nullable();
            $table->string('ssc_total_marks', 255)->nullable();
            $table->string('ssc_document', 255)->nullable();
            $table->string('hssc_degree', 255)->nullable();
            $table->string('hssc_group', 255)->nullable();
            $table->string('hssc_board', 255)->nullable();
            $table->string('hssc_institue', 255)->nullable();
            $table->string('hssc_passing_year', 255)->nullable();
            $table->string('hssc_roll_number', 255)->nullable();
            $table->string('hssc_obt_marks', 255)->nullable();
            $table->string('hssc_total_marks', 255)->nullable();
            $table->string('hssc_document', 255)->nullable();
            $table->string('deleted', 255)->default('0');
            $table->string('status', 255)->default('1');
            $table->unsignedBigInteger('userid')->nullable();
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_details');
    }
}
