<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_dates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->dateTime('start')->nullable();
            $table->dateTime('finish')->nullable();
            $table->text('memo')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('project_id')
                  ->references('id')
                  ->on('projects')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_dates');
    }
}
