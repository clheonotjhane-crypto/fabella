<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // gender: varchar(100), NOT NULL
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender', 100)->nullable(false)->change();
        });

        // drop and recreate status as enum
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->enum('status', ['Admin', 'User'])->nullable()->default('User');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender', 100)->nullable()->change();
            $table->dropColumn('status');
            $table->string('status', 100)->nullable()->default('User');
        });
    }
};
