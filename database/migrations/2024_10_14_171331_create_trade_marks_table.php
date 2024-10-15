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
        Schema::create('trade_marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->default(null);
            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_id')->references('id')->on('trade_marks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_marks');
    }
};
