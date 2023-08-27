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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('husbandName')->nullable();
            $table->foreignId('village_id')->constrained('villages');
            $table->string('mobile',10)->nullable();
            $table->string('currDeliveryCount',2)->nullable();
            $table->string('prevChildAge',2)->nullable();
            $table->string('previousDeliveryType',1)->nullable();
            $table->string('sexPreviousChild',1)->nullable();
            $table->string('tt1switch',10)->nullable();
            $table->string('tt2switch',10)->nullable();
            $table->string('ttbswitch',10)->nullable();
            $table->string('counsDiet',1)->nullable();
            $table->foreignId('asha_id')->constrained('users');
            $table->foreignId('anm_id')->constrained('users');
            $table->foreignId('gdmo_id')->constrained('users');
            $table->foreignId('gyno_id')->constrained('users');
            $table->foreignId('dcotor_id')->constrained('users');
            $table->string('rchid')->nullable();
            $table->string('mothername')->nullable();
            $table->string('ageatmarriage',2)->nullable();
            $table->string('dob',10)->nullable();
            $table->string('bankname')->nullable();
            $table->string('accountno',25)->nullable();
            $table->string('ifsccode',11)->nullable();
            $table->string('caste',1)->nullable();
            $table->string('economy',1)->nullable();
            $table->string('address')->nullable();
            $table->string('Lmp',10)->nullable();
            $table->string('edd',10)->nullable();
            $table->string('weight',3)->nullable();
            $table->string('height',10)->nullable();
            $table->string('pastillness')->nullable();
            $table->string('JSYBeneficiary',1)->nullable();
            $table->string('badhistory')->nullable();
            $table->string('siteofdelivery')->nullable();
            //anc1
            $table->string('anc1_date',10)->nullable();
            $table->string('anc1_weekofpregnancy',2)->nullable();
            $table->string('anc1_bpSystolic',3)->nullable();
            $table->string('anc1_bpDiastolic',3)->nullable();
            $table->string('anc1_fundalheight',10)->nullable();
            $table->string('anc1_bloodsugarfasting',10)->nullable();
            $table->string('anc1_bloodsugarpost',10)->nullable();
            $table->string('anc1_highrisk',1)->nullable();
            $table->string('anc1_hblevel',2)->nullable();
            $table->string('anc1_urinesugar',2)->nullable();
            $table->string('anc1_urinealbumin',2)->nullable();
            $table->string('anc1_folictabcount',3)->nullable();
            $table->string('anc1_folicdate',10)->nullable();
            $table->string('anc1_ifatabcount',3)->nullable();
            $table->string('anc1_ifadate',10)->nullable();
            $table->string('anc1_counselling',1)->nullable();
            //anc2
            $table->string('anc2_date',10)->nullable();
            $table->string('anc2_bp',3)->nullable();
            $table->string('anc2_bloodsugar',3)->nullable();
            $table->string('anc2_highrisk',1)->nullable();
            $table->string('anc2_hblevel',2)->nullable();
            $table->string('anc2_fundalheight',10)->nullable();
            $table->string('anc2_Foetalheartrate',3)->nullable();
            $table->string('anc2_FoetalMovements',1)->nullable();
            $table->string('anc2_usg',1)->nullable();
            //anc3
            $table->string('anc3_date',10)->nullable();
            $table->string('anc3_bp',3)->nullable();
            $table->string('anc3_bloodsugar',3)->nullable();
            $table->string('anc3_highrisk',1)->nullable();
            $table->string('anc3_hblevel',2)->nullable();
            $table->string('anc3_fundalheight',10)->nullable();
            $table->string('anc3_Foetalheartrate',3)->nullable();
            $table->string('anc3_FoetalMovements',1)->nullable();
            $table->string('anc3_usg',1)->nullable();
            //anc4
            $table->string('anc4_date',10)->nullable();
            $table->string('anc4_bp',3)->nullable();
            $table->string('anc4_bloodsugar',3)->nullable();
            $table->string('anc4_highrisk',1)->nullable();
            $table->string('anc4_hblevel',2)->nullable();
            $table->string('anc4_fundalheight',10)->nullable();
            $table->string('anc4_Foetalheartrate',3)->nullable();
            $table->string('anc4_FoetalMovements',1)->nullable();
            $table->string('anc4_Foetalpresentation',1)->nullable();
            $table->string('anc4_usg',1)->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
