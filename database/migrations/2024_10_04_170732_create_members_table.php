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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('nim');
            $table->string('email');
            $table->string('wa');
            $table->boolean('p1')->default(false);
            $table->boolean('p2')->default(false);
            $table->boolean('p3')->default(false);
            $table->boolean('p4')->default(false);
            $table->boolean('p5')->default(false);
            $table->boolean('p6')->default(false);
            $table->boolean('p7')->default(false);
            $table->boolean('p8')->default(false);
            $table->boolean('p9')->default(false);
            $table->boolean('p10')->default(false);
            $table->boolean('p11')->default(false);
            $table->boolean('p12')->default(false);
            $table->boolean('p13')->default(false);
            $table->boolean('p14')->default(false);
            $table->boolean('p15')->default(false);
            $table->boolean('p16')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
