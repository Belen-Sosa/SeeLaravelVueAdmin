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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->unsignedBigInteger('career_id');
            $table->unsignedBigInteger('subject_id');
            $table->text('description');
            $table->boolean('estate');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('final_date')->nullable();
            $table->timestamps();

            
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('career_id')->references('id')->on('careers')->onDelete('cascade');;
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey');
    }
};
