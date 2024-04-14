<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 2024_04_13_122721_products_type.php
     */
    public function up(): void
    {
        Schema::create('products_type', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price', 22,2)->unsigned();
            $table->integer('years')->unsigned()->nullable();
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
