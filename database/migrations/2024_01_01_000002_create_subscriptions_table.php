<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('webmaster_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('offer_id')->constrained('offers')->onDelete('cascade');
            $table->decimal('price_per_click', 10, 2); // webmaster's agreed price
            $table->string('token', 64)->unique();      // unique redirect token
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['webmaster_id', 'offer_id']);
            $table->index('token');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
