<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversitySocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('university_socials', function (Blueprint $table) {
            $table->id();
            $table->string('url', 255)->nullable();
            $table->string('userid', 255)->nullable();
            $table->string('deleted', 255)->default('0');
            $table->string('status', 255)->default('1');
            $table->unsignedBigInteger('universityid')->nullable();
            $table->unsignedBigInteger('socialid')->nullable();
            $table->foreign('universityid')->references('id')->on('university_information')->onDelete('cascade');
            //$table->foreign('socialid')->references('id')->on('socials')->onDelete('cascade');
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
        Schema::dropIfExists('university_socials');
    }
}
