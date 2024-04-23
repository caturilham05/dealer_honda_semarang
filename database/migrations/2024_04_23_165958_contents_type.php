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
        Schema::create('content_type', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->tinyInteger('is_active')->unsigned()->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->string('create_by_name', 255)->nullable();
            $table->dateTime('modifed')->nullable();
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
