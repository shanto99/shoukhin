<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grabs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('p_id');
            $table->integer('ft_qty');
            $table->integer('ft_price');
            $table->integer('st_qty');
            $table->integer('st_prie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('grabs');
    }
}
