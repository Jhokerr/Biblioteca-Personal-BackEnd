<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Agregar solo las columnas que falten
            if (!Schema::hasColumn('books', 'description')) {
                $table->text('description')->nullable()->after('author');
            }
            if (!Schema::hasColumn('books', 'genre')) {
                $table->string('genre')->nullable()->after('description');
            }
            if (!Schema::hasColumn('books', 'published_year')) {
                $table->integer('published_year')->nullable()->after('genre');
            }
            if (!Schema::hasColumn('books', 'pages')) {
                $table->integer('pages')->nullable()->after('published_year');
            }
            if (!Schema::hasColumn('books', 'cover_url')) {
                $table->string('cover_url')->nullable()->after('pages');
            }
            if (!Schema::hasColumn('books', 'reading_status')) {
                $table->string('reading_status')->default('Por Leer')->after('cover_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['description', 'genre', 'published_year', 'pages', 'cover_url', 'reading_status']);
        });
    }
};