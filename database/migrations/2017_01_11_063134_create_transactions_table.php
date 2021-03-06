<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('symbol');
            $table->string('name');
            $table->string('exchange');
            $table->string('type');
            $table->string('notes');
            $table->integer('qty');
            $table->decimal('price',32,4);
            $table->decimal('account',32,4);
            $table->decimal('cash',32,4);
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
        Schema::dropIfExists('transactions');
    }
}
