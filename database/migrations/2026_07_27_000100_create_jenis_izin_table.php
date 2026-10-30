<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('jenis_izin', function(Blueprint $t){ $t->id(); $t->string('nama_jenis_izin'); $t->text('deskripsi')->nullable(); $t->timestamps(); }); } public function down(): void { Schema::dropIfExists('jenis_izin'); } };
