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
        Schema::create('events', function (Blueprint $table) {
            $table->unsignedBigInteger('id_event', true)->primary();
            $table->unsignedBigInteger('host')->nullable(false); 
            $table->string('tags', 64);
            $table->string('nama', 255);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('alamat');
            $table->tinyInteger('progress_event')->default(0);
            $table->text('event_detail');
            $table->text('requirement');
            $table->smallInteger('total_volunteer')->default(0);
            $table->integer('target_donasi')->default(0);
            $table->json('event_image');
            $table->enum('status', ['approved', 'pending', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('host')->references('id')->on('users')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
