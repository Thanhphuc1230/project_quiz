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
        Schema::create('tp_categories', function (Blueprint $table) {
            $table->id('id_category');
            $table->uuid('uuid_category');
            $table->string('name_cate');
            $table->unsignedTinyInteger('status_cate');
            $table->string('link')->nullable();;
            $table->integer('parent_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tp_categories');
    }
};
