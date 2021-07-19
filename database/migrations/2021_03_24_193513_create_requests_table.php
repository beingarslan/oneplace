<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('university_requests', function (Blueprint $table) {
            $table->id();
            $table->string('university_name', 255)->nullable();
            $table->string('university_email', 255)->nullable();
            $table->string('university_address', 255)->nullable();
            $table->string('university_website', 255)->nullable();
            $table->string('letter', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('deleted', 255)->default('0');
            $table->string('status', 255)->default('1');
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
        Schema::dropIfExists('university_requests');
    }
}
