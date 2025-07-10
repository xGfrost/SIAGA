<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->double('water_level_cm');
            $table->double('rainfall_mm');
            $table->timestamp('created_at')->useCurrent(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};

