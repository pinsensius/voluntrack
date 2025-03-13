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
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->string("order_id");
            $table->unsignedBigInteger("donatur")->nullable(true);
            $table->unsignedBigInteger("event_id")->nullable(true);
            $table->decimal("amount", 15,2);
            $table->string("payment_type",50);
            $table->string("transaction_status",50);
            $table->timestamps();

            $table->foreign('event_id')->references("id_event")->on("events")->onDelete("cascade");
            $table->foreign("donatur")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};
