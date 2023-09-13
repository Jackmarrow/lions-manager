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
        Schema::create('resv_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("classe_id")->constrained();
            $table->foreignId('user_id')->constrained();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->boolean("resv_etat");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resv_classes');
    }
};
