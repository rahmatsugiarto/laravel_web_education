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
        Schema::create('educational_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('type'); // Tipe materi: 'article', 'image', 'audio', 'video'
            $table->string('file_path')->nullable(); // Untuk menyimpan path file multimedia
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pengguna yang mengupload
            $table->boolean('is_approved')->default(false); // Status approval oleh admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_materials');
    }
};
