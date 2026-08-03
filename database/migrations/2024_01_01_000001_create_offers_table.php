<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advertiser_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('target_url');
            $table->decimal('price_per_click', 10, 2);
            $table->string('topics')->nullable(); // comma-separated topics
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('advertiser_id');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
