<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->string('symbol', 32)->index();
            $table->enum('condition', ['greater_than', 'less_than']);
            $table->decimal('target_price', 18, 8);
            $table->boolean('is_triggered')->default(false)->index();
            $table->timestamp('triggered_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
