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
        Schema::create('password_resets_custom', function (Blueprint $table) {
            $table->id();

            // Relasi user
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Kode OTP 4 digit
            $table->string('code', 4);

            // Expired 5 menit
            $table->timestamp('expires_at');

            // Apakah kode sudah digunakan
            $table->boolean('used')->default(false);

            // Email opsional sebagai penyimpanan tambahan
            $table->string('email');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets_custom');
    }
};
