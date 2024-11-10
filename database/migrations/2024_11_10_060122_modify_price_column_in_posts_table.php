<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify price column in the post table
        Schema::table('posts', function (Blueprint $table) {
            $table->decimal('price', 15, 2)->change(); // Allows up to 9999999999999.99 (15 digits, 2 d.p)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert the price column to its previous configuration
        Schema::table('posts', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->change(); //Restores to original configuration
        });
    }
};
