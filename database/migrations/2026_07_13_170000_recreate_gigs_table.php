<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('gigs');
        Schema::create('gigs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('basic_name')->default('Basic');
            $table->string('basic_price');
            $table->text('basic_features')->nullable();
            $table->string('standard_name')->default('Standard');
            $table->string('standard_price');
            $table->text('standard_features')->nullable();
            $table->string('premium_name')->default('Premium');
            $table->string('premium_price');
            $table->text('premium_features')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('conversations', function (Blueprint $table) {
            $table->foreignId('gig_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropForeign(['gig_id']);
            $table->dropColumn('gig_id');
        });
        Schema::dropIfExists('gigs');
    }
};
