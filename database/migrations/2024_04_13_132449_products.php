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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_type_id')->unsigned();
            $table->index('product_type_id');
            $table->foreign('product_type_id')->references('id')->on('products_type')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('promo_id')->unsigned()->nullable();
            $table->index('promo_id');
            $table->foreign('promo_id')->references('id')->on('promo')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->text('specification')->nullable();
            $table->text('special_feature')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->text('images')->nullable();
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
