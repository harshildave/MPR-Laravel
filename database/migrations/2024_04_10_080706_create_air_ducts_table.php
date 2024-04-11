<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_ducts', function (Blueprint $table) {
            $table->id();
            $table->enum('no_of_furnace', ['1', '2', '3+']);
            $table->integer('square_footage_min');
            $table->integer('square_footage_max');
            $table->double('price_side_by_side')->nullable();
            $table->double('price_different_location')->nullable();
            $table->double('price_no_location')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airducts');
    }
};
