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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('cui')->index();
            $table->string('contact_person')->index();
            $table->string('email');
            $table->string('phone');
            $table->string('reg_com');
            $table->string('office_address');
            $table->string('capital_social')->nullable();
            $table->string('euid')->nullable();
            $table->string('bank')->nullable();
            $table->string('iban')->nullable();
            $table->boolean('vat')->default(true);
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
