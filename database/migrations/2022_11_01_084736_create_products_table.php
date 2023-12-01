<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('size')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('packaging_type')->nullable();
            $table->string('packaging_size')->nullable();
            $table->string('text')->nullable();
            $table->float('price',8, 2)->nullable();
            $table->float('gst',8, 2)->nullable();
            $table->float('gst_amount',8, 2)->nullable();
            $table->float('price_with_gst',8, 2)->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
