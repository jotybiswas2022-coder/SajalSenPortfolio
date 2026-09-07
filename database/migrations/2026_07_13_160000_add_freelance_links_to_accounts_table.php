<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->string('fiverr')->nullable()->after('youtube');
            $table->string('upwork')->nullable()->after('fiverr');
            $table->string('freelancer')->nullable()->after('upwork');
        });
    }

    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn(['fiverr', 'upwork', 'freelancer']);
        });
    }
};
