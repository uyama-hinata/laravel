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
            $table->integer('id')->autoIncrement();
            $table->integer('member_id');
            $table->integer('product_category_id');
            $table->integer('product_subcategory_id');
            $table->string('name',255);
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->integer('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->text('product_content');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
