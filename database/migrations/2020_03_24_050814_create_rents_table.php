<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->integer('user_id');
            $table->integer('subtotal');
            $table->integer('assurance');
            $table->integer('total');
            $table->string('notes')->nullable();
            $table->bigInteger('overchage')->default('0');
            $table->bigInteger('damage_fee')->default('0');
            $table->enum('picked_up',['0','1','2'])->default('0');
            $table->enum('returned',['0','1','2'])->default('0');
            $table->enum('paid',['0','1','2'])->default('0');
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
        Schema::dropIfExists('rents');
    }
}
