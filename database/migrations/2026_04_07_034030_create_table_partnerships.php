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
        Schema::create('boss_partnerships', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('perusahaan')->nullable();
            $table->string('email');
            $table->string('whatsapp');
            $table->string('kota');
            $table->string('nama_bank');
            $table->string('nomor_rekening');
            $table->string('nama_rekening');
            $table->text('value');
            $table->string('referral_code')->unique()->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('agr_accuracy')->default(false);
            $table->boolean('agr_contact')->default(false);
            $table->boolean('agr_terms')->default(false);
            $table->timestamp('email_sent_at')->nullable();
            $table->timestamp('wa_sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boss_partnerships');
    }
};
