<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('city_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable()->constrained();
            $table->string('contact');
            $table->string('phone');
            $table->enum('status', [Order::PENDING, Order::PAYED, Order::ON_ROUTE, Order::DELIVERED, Order::CANCELED])->default(Order::PENDING);
            $table->enum('shipping_type', [1, 2]);
            $table->float('shipping_cost');
            $table->float('total');
            $table->json('content');
            $table->string('address')->nullable();
            $table->string('reference')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
