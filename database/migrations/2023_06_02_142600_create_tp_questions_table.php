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
        Schema::create('tp_question', function (Blueprint $table) {
            $table->id('id_question');
            $table->uuid('uuid_question');
            $table->string('quiz');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c');
            $table->string('option_d');
            $table->string('answers',2);
            $table->string('explain');
            $table->unsignedTinyInteger('status_quiz');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tp_question');
    }
};
