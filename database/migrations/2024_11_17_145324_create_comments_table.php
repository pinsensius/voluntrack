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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_topic");
            $table->unsignedBigInteger("id_commenter");
            $table->text("comment");
            $table->dateTime("tanggal_dibuat");
            $table->timestamps();
            
            $table->foreign("id_topic")->references("id")->on("topics")->onDelete("cascade");
            $table->foreign("id_commenter")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
