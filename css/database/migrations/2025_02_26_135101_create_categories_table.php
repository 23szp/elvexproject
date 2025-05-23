<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // INT UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('name'); // Kategória neve
            $table->string('slug')->unique(); // Egyedi slug (URL-barát név)
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade'); // Szülőkategória
            $table->timestamps(); // created_at és updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
