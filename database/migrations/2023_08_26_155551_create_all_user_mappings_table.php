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
        Schema::create('all_user_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cmo_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('smo_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('gyno_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('doctor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('anm_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('asha_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('village_id')->nullable()->constrained('villages')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('all_user_mappings');
    }
};
