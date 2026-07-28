<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::create('prompts', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();


            $table->text('prompt');


            $table->text('description')
                  ->nullable();


            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();


            $table->timestamps();

        });

    }


    public function down(): void
    {
        Schema::dropIfExists('prompts');
    }

};