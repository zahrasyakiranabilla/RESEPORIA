<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->string('session_id'); // untuk track favorite tanpa login
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['session_id', 'recipe_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
};