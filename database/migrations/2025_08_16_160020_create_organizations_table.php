<?php

use App\Models\Activity;
use App\Models\Building;
use App\Models\Organization;
use App\Models\OrganizationActivity;
use App\Models\OrganizationPhone;
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
        Schema::create(Organization::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('building_id');
            $table->timestamps();

            $table->foreign('building_id')->on(Building::TABLE_NAME)->references('id');
        });

        Schema::create(OrganizationPhone::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->string('phone');
            $table->timestamps();

            $table->foreign('organization_id')->on(Organization::TABLE_NAME)->references('id')->onDelete('cascade');
        });

        Schema::create(OrganizationActivity::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('activity_id');
            $table->timestamps();

            $table->foreign('organization_id')->on(Organization::TABLE_NAME)->references('id')->onDelete('cascade');
            $table->foreign('activity_id')->on(Activity::TABLE_NAME)->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(OrganizationPhone::TABLE_NAME);
        Schema::dropIfExists(OrganizationActivity::TABLE_NAME);
        Schema::dropIfExists(Organization::TABLE_NAME);
    }
};
