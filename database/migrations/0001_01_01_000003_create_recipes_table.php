<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->enum('category', ['Appetizer', 'Main Course', 'Dessert', 'Drinks']);
            $table->decimal('rating', 2, 1)->default(4.5);
            $table->integer('likes')->default(0);
            $table->integer('cooking_time'); // dalam menit
            $table->json('ingredients');
            $table->text('instructions');
            $table->string('video_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipes');
    }
};