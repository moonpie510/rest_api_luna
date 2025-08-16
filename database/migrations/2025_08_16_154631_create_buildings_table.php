<?php

use App\Models\Building;
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
        Schema::create(Building::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->decimal('latitude', 12, 8);
            $table->decimal('longitude', 12, 8);
            $table->string('address', 1024);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Building::TABLE_NAME);
    }
};
