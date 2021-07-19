<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('more_info', 255)->nullable();
            $table->string('criteria', 255)->nullable();
            $table->string('award_of_degree', 255)->nullable();
            $table->string('deleted', 255)->default('0');
            $table->string('status', 255)->default('1');
            $table->unsignedBigInteger('universityid')->nullable();
            $table->unsignedBigInteger('userid')->nullable();
            $table->unsignedBigInteger('departmentid')->nullable();
            $table->foreign('universityid')->references('id')->on('university_information')->onDelete('cascade');
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('departmentid')->references('id')->on('departments')->onDelete('cascade');
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
        Schema::dropIfExists('programs');
    }
}
