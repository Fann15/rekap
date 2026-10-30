<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model; use Illuminate\Database\Eloquent\Relations\BelongsTo;
class DataPerizinan extends Model { protected $table='data_perizinan'; protected $fillable=['user_id','jenis_izin_id','nama_pemohon','tanggal_pengajuan','tanggal_selesai','status','status_verifikasi','keterangan','catatan_verifikasi','periode_bulan','periode_tahun','diverifikasi_oleh','diverifikasi_pada']; protected $casts=['tanggal_pengajuan'=>'date','tanggal_selesai'=>'date','diverifikasi_pada'=>'datetime']; public function user(): BelongsTo{return $this->belongsTo(User::class);} public function jenisIzin(): BelongsTo{return $this->belongsTo(JenisIzin::class);} public function verifier(): BelongsTo{return $this->belongsTo(User::class,'diverifikasi_oleh');} }
