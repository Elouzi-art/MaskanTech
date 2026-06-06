<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE properties MODIFY COLUMN type ENUM('house','apartment','studio','room','colocation','land','office')");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE properties MODIFY COLUMN type ENUM('house','apartment','land','office')");
    }
};