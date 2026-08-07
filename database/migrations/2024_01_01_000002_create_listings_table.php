<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('reference')->unique();
            $table->string('address_line_1');
            $table->string('city');
            $table->string('postcode');
            $table->unsignedInteger('price');
            $table->unsignedTinyInteger('bedrooms');
            $table->unsignedTinyInteger('bathrooms');
            $table->string('property_type');
            $table->string('status')->default('draft');
            $table->timestamp('listed_at')->nullable();
            $table->timestamps();

            // The listings index filters on status and orders by listed_at on
            // every request; the remaining columns back the optional filters.
            $table->index(['status', 'listed_at']);
            $table->index('price');
            $table->index('bedrooms');
            $table->index('property_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
