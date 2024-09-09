<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ensure this column exists
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('duration')->nullable(); // Duration in days
            $table->date('departure_date')->nullable();
            $table->date('return_date')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('package_image')->nullable(); // Ensure this column exists if you're storing images
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
}


