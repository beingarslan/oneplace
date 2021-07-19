<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEligibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eligibilities', function (Blueprint $table) {
            $table->id();
            $table->string('degree', 255)->nullable();
            $table->integer('marks')->default(50);
            $table->string('description', 255)->nullable();
            $table->string('deleted', 255)->default('0');
            $table->string('status', 255)->default('1');
            $table->unsignedBigInteger('universityid')->nullable();
            $table->unsignedBigInteger('userid')->nullable();
            $table->unsignedBigInteger('programid')->nullable();
            $table->foreign('universityid')->references('id')->on('university_information')->onDelete('cascade');
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('programid')->references('id')->on('programs')->onDelete('cascade');
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
        Schema::dropIfExists('eligibilities');
    }
}
