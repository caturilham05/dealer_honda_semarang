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
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('content_type_id')->unsigned();
            $table->index('content_type_id');
            $table->foreign('content_type_id')->references('id')->on('content_type')->onUpdate('cascade')->onDelete('cascade');
            $table->text('title');
            $table->text('description')->nullable();
            $table->text('keyword')->nullable();
            $table->text('tags')->nullable();
            $table->text('intro')->nullable();
            $table->text('image')->nullable();
            $table->text('images')->nullable();
            $table->tinyInteger('is_active')->unsigned()->default(0);
            $table->bigInteger('created_by')->unsigned();
            $table->string('create_by_name', 255)->nullable();
            $table->dateTime('modifed')->nullable();
            $table->tinyInteger('ordering')->unsigned()->default(0)->nullable();
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
