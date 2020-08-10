<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->index();
            $table->unsignedInteger('tariff_id')->nullable()->index();
            $table->tinyInteger('tariff_period');
            $table->decimal('amount', 8, 2);
            $table->string('status')->default('wait_payment');
            $table->string('order_id')->nullable();
            $table->string('error')->nullable();
            $table->string('name')->nullable();
            $table->string('kpp')->nullable();
            $table->string('inn')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
