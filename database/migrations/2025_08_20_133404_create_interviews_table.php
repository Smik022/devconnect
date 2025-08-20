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
        Schema::create('interviews', function (Blueprint $t) {
            $t->id();
            $t->foreignId('employer_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('developer_id')->constrained('users')->cascadeOnDelete();
            $t->foreignId('job_post_id')->nullable()->constrained('job_posts')->nullOnDelete();

            $t->string('title');
            $t->enum('type', ['interview','meeting','milestone'])->default('interview');
            $t->text('notes')->nullable();
            $t->string('location')->nullable();  
            $t->dateTime('scheduled_at');
            $t->integer('duration_minutes')->default(30);

            $t->integer('reminder_minutes_before')->default(60);
            $t->timestamp('reminder_sent_at')->nullable();

            $t->enum('status', ['scheduled','completed','cancelled'])->default('scheduled');
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
