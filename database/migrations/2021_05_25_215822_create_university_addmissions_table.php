<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversityAddmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('university_addmissions', function (Blueprint $table) {
            $table->id();
            $table->string('description', 255)->nullable();
            $table->string('cover', 255)->nullable();
            $table->date('last_date')->nullable();
            $table->string('deleted', 255)->default('0');
            $table->string('status', 255)->default('1');
            $table->unsignedBigInteger('programid')->nullable();
            $table->unsignedBigInteger('userid')->nullable();
            $table->foreign('programid')->references('id')->on('programs')->onDelete('cascade');
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
        Schema::dropIfExists('university_addmissions');
    }
}
