<?php

// database/migrations/xxxx_xx_xx_create_postings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostingsTable extends Migration
{
    public function up()
    {
        Schema::create('postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->timestamps(); // This will create created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('postings');
    }
}

