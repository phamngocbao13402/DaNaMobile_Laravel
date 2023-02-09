<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_variations_options_value', function (Blueprint $table) {
            $table->id();
            $table->string('variation_name', 100);
            $table->string('variation_value', 100);

            $table->foreignId('products_variation_id')
                ->constrained('products_variations_options')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamp('deleted_at')->nullable();


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
        Schema::dropIfExists('products_variations_options_value');
    }
};
