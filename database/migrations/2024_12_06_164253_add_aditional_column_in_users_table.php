<?php

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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 60)->after('name')->index();
            $table->bigInteger('province_id')->nullable()->after('password')->index();
            $table->bigInteger('city_id')->nullable()->after('province_id')->index();
            $table->bigInteger('distict_id')->nullable()->after('city_id')->index();
            $table->bigInteger('village_id')->nullable()->after('distict_id')->index();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('province_id');
            $table->dropColumn('city_id');
            $table->dropColumn('distict_id');
            $table->dropColumn('village_id');

            $table->dropIndex('distict_id');
            $table->dropIndex('village_id');
            $table->dropIndex('city_id');
            $table->dropIndex('province_id');
            $table->dropIndex('username');

        });
    }
};
