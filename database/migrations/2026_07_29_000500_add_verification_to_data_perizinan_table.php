<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('data_perizinan', function (Blueprint $table) {
            $table->enum('status_verifikasi', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu')->after('status');
            $table->text('catatan_verifikasi')->nullable()->after('keterangan');
            $table->foreignId('diverifikasi_oleh')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
            $table->timestamp('diverifikasi_pada')->nullable()->after('diverifikasi_oleh');
        });
    }

    public function down(): void {
        Schema::table('data_perizinan', function (Blueprint $table) {
            $table->dropForeign(['diverifikasi_oleh']);
            $table->dropColumn(['status_verifikasi', 'catatan_verifikasi', 'diverifikasi_oleh', 'diverifikasi_pada']);
        });
    }
};
