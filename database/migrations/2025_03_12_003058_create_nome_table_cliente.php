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
        DB::statement("CREATE TABLE `clientes` (
                `recnum` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                `empresa` DECIMAL(4,0) NOT NULL,
                `codigo` DECIMAL(14,0) NOT NULL,
                `razao_social` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_unicode_ci',
                `tipo` ENUM('PJ','PF') NOT NULL COLLATE 'utf8mb4_unicode_ci',
                `cpf_cnpj` VARCHAR(14) NOT NULL COLLATE 'utf8mb4_unicode_ci',
                `created_at` TIMESTAMP NULL DEFAULT NULL,
                `updated_at` TIMESTAMP NULL DEFAULT NULL,
                PRIMARY KEY (`codigo`) USING BTREE,
                UNIQUE INDEX `recnum` (`recnum`) USING BTREE,
                INDEX `FK_clientes_empresas` (`empresa`) USING BTREE,
                CONSTRAINT `FK_clientes_empresas` FOREIGN KEY (`empresa`) REFERENCES `empresas` (`codigo`) ON UPDATE RESTRICT ON DELETE RESTRICT
                )
            COLLATE='utf8mb4_unicode_ci'
            ENGINE=InnoDB
            ;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
