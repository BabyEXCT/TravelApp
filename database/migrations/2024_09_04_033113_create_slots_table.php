<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlotsTable extends Migration
{
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id'); // Foreign key to the packages table
            $table->integer('slot_number'); // You can customize the slot details as needed
            $table->integer('available_slots'); // Number of available slots
            $table->decimal('price', 8, 2)->nullable(); // Price per slot, if different from the package price
            $table->timestamps();

            // Set up foreign key constraint
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('slots');
    }
}
