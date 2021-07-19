<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversityInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('university_information', function (Blueprint $table) {
            $table->id();
            $table->string('logo', 255)->nullable();
            $table->string('cover', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('username', 255)->nullable();
            $table->string('about', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('date_of_established', 255)->nullable();
            $table->string('primary_phone', 255)->nullable();
            $table->string('website', 255)->nullable();
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
        Schema::dropIfExists('university_informations');
    }
}
