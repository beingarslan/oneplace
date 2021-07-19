<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppliedAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applied_admissions', function (Blueprint $table) {
            $table->id();
            $table->string('deleted', 255)->default('0');
            $table->string('status', 255)->default('1');
            $table->unsignedBigInteger('university_addmissionid')->nullable();
            $table->unsignedBigInteger('userid')->nullable();
            $table->foreign('userid')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('university_addmissionid')->references('id')->on('university_addmissions')->onDelete('cascade');
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
        Schema::dropIfExists('applied_admissions');
    }
}
