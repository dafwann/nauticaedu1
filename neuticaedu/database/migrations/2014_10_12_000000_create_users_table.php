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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // FORM REGISTER: username, email, password
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');

            // ROLE: default user, admin dibuat lewat seeder
            $table->string('role')->default('user');

            $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');


            // VERIFIKASI EMAIL
            $table->boolean('is_verified')->default(0); 
            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
