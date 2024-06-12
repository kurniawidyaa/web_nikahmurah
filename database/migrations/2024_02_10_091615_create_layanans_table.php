<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->references('id')->on('kategori_layanans')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('discount_id')->references('id')->on('discounts')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->string('name');
            $table->string('identifier');
            $table->string('thumbnail')->nullable();
            $table->text('description');
            $table->text('note')->nullable();
            $table->bigInteger('qty')->nullable();
            $table->bigInteger('price');
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
        Schema::dropIfExists('layanan');
    }
}
