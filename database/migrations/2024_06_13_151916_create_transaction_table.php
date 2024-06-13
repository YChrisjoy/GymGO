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
        Schema::create('paket_membership', function (Blueprint $table) {
            $table->uuid('id_membership')->primary();
            $table->string('name_membership');
            $table->date('duration');
            $table->string('price');
            $table->timestamps();
        });

        Schema::create('transaksi_beli', function (Blueprint $table) {
            $table->uuid('id_transaksi')->primary();
            $table->dateTime('waktu_transaksi');
            $table->string('jenis_transaksi');
            $table->date('tanggal_transaksi');
            $table->timestamps();
        });

        Schema::create('membership_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->uuid('membership_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            // Define the foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('membership_id')->references('id_membership')->on('paket_membership')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_beli');
        Schema::dropIfExists('paket_membership');
        Schema::dropIfExists('membership_user');
    }
};
