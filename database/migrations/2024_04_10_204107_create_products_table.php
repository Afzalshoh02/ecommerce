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
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->integer('bland_id')->nullable();
            $table->double('old_price')->default(0);
            $table->double('price')->default(0);
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->text('additional_information')->nullable();
            $table->text('shipping_returns')->nullable();
            $table->tinyInteger('status')->default(0)->comment('1 - Inactive, 0 - Active');
            $table->tinyInteger('is_deleted')->default(0)->comment('0 - not delete, 1 - delete');
            $table->integer('created_by')->nullable();
            $table->timestamps();
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
