<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('age');
            $table->enum('gender', ['male', 'female']);
            $table->integer('examination_id')->unsigned();
            $table->foreign('examination_id')->references('id')->on('examinations')->onDelete('cascade');
            $table->integer('specialty_id')->unsigned();
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('cascade');
            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->integer('day_id')->unsigned();
            $table->foreign('day_id')->references('id')->on('workdays')->onDelete('cascade');
            $table->date('date');
            $table->decimal('price', 8, 2);
            $table->string('code')->nullable();
            $table->tinyInteger('is_completed')->default('0');
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
        Schema::dropIfExists('reservations');
    }
}
