<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('student_Fname', 255);
            $table->string('student_Mname', 255)->nullable();
            $table->string('student_Lname', 255);
            $table->string('student_Email', 255);
            $table->date('student_Birthdate');
            $table->string('student_Gender', 10);

            $table->unsignedBigInteger('program_id')->unsigned()->comment('Program foreign key');
            $table->string('student_Number', 11);
            $table->string('student_YearLevel', 10);
            $table->string('student_Status', 50);
            $table->string('student_Notes')->nullable();

            $table->string('student_Image', 255)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('program_id')->references('program_id')->on('programs');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        ;
        Schema::table('students', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
