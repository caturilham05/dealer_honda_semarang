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
        Schema::create('tenor', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('tenor')->unsigned()->default(0)->nullable();
            $table->string('unit')->nullable();
            $table->tinyInteger('is_active')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
