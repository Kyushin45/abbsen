<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('relawan_id')
                ->constrained('relawans')
                ->restrictOnDelete();

            $table->dateTime('tanggal_masuk');
            $table->dateTime('tanggal_keluar')->nullable();

            $table->timestamps();

            $table->index(['relawan_id', 'tanggal_masuk']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensis');
    }
};
