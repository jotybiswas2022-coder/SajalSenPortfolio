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
        Schema::table('accounts', function (Blueprint $table) {
            $table->string('github')->nullable()->after('cv');
            $table->string('linkedin')->nullable()->after('github');
            $table->string('facebook')->nullable()->after('linkedin');
            $table->string('twitter')->nullable()->after('facebook');
            $table->string('youtube')->nullable()->after('twitter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn(['github', 'linkedin', 'facebook', 'twitter', 'youtube']);
        });
    }
};
