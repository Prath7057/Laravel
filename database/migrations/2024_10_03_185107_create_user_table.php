<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('user_id')->primary(); 
            $table->string('user_username');
            $table->string('user_email');                
            $table->string('user_password');  
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
