<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('
        CREATE TABLE `empresas` (
            `recnum` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            `codigo` DECIMAL(4,0) NOT NULL,
            `empresa` DECIMAL(4,0) NOT NULL,
            `sigla` VARCHAR(40) NOT NULL COLLATE "utf8mb4_unicode_ci",
            `razao_social` VARCHAR(255) NOT NULL COLLATE "utf8mb4_unicode_ci",
            `created_at` TIMESTAMP NULL DEFAULT NULL,
            `updated_at` TIMESTAMP NULL DEFAULT NULL,
            PRIMARY KEY (`codigo`) USING BTREE,
            UNIQUE INDEX `recnum` (`recnum`) USING BTREE
        )
        COLLATE="utf8mb4_unicode_ci"
        ENGINE=InnoDB
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
