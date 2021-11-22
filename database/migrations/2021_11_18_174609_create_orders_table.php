<?php

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
            
            $table->string('code')->nullable();
            $table->string('order_code')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('order_date')->nullable();
            //by customer
            $table->unsignedBigInteger('contact_id')->nullable();
           
            //by admin
            //from
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('cus_address')->nullable();

            $table->string('phone')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->text('goods')->nullable();
            $table->unsignedBigInteger('qty')->nullable();
            $table->string('price')->nullable();
            
            $table->foreign('contact_id')
            ->references('id')
            ->on('contacts')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            

            $table->foreign('status_id')
            ->references('id')
            ->on('statuses')
            ->onDelete('cascade');

             $table->softDeletes();
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
