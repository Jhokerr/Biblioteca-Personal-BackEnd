<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->integer('published_year')->nullable();
            $table->integer('pages')->nullable();
            $table->string('cover_url')->nullable();
            $table->string('reading_status')->default('Por Leer');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['published_year', 'pages', 'cover_url', 'reading_status']);
        });
    }
};
