<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');;
            $table->integer('from')->unsigned();
            $table->integer('to')->unsigned();
            $table->unsignedInteger('proposal_id')->index();
            $table->boolean('file_status')->default(false);
            $table->string('file_path')->nullable();
            $table->text('text')->nullable();
            $table->boolean('admin')->default(0);
            $table->boolean('admin_id')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
