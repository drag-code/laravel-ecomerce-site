<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

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
            $table->foreignId('subcategory_id')->constrained();
            $table->foreignId('brand_id')->constrained();
            $table->string('name');
            $table->text('description');
            $table->string('slug');
            $table->integer('price');
            $table->integer('quantity')->nullable();
            $table->enum('status', [Product::DRAFT, Product::PUBLISHED])
                ->default(Product::DRAFT);
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
