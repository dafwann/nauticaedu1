<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('email_verifications', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('code', 4);
            $table->timestamp('expires_at');
            $table->boolean('used')->default(false);

            $table->string('email');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_verifications');
    }
};
