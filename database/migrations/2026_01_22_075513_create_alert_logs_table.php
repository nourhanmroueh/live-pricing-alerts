<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alert_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alert_id')->constrained('alerts')->cascadeOnDelete();
            $table->decimal('price_at_trigger', 18, 8);
            $table->timestamp('triggered_at');
            $table->timestamps();

            $table->index(['alert_id', 'triggered_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alert_logs');
    }
};
