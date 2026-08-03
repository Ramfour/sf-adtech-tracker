<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained('subscriptions')->onDelete('cascade');
            $table->foreignId('offer_id')->constrained('offers')->onDelete('cascade');
            $table->foreignId('webmaster_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('advertiser_id')->constrained('users')->onDelete('cascade');
            $table->string('ip', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->boolean('redirected')->default(false); // false = rejected (not subscribed)
            $table->decimal('amount', 10, 2);              // price at click time
            $table->decimal('commission', 10, 2);          // system commission
            $table->decimal('webmaster_earning', 10, 2);   // webmaster share
            $table->timestamps();

            $table->index('subscription_id');
            $table->index('offer_id');
            $table->index('webmaster_id');
            $table->index('advertiser_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clicks');
    }
};
