<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rsvps', function (Blueprint $table) {
            $table->boolean('attending')->nullable()->after('code');
            $table->boolean('dietary_requirements')->nullable()->after('attending');
        });
    }

    public function down(): void
    {
        Schema::table('rsvps', function (Blueprint $table) {
            $table->dropColumn('attending');
            $table->dropColumn('dietary_requirements');
        });
    }
};
