<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model; use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PenilaianKinerja extends Model { protected $table='penilaian_kinerja'; protected $fillable=['user_id','kecakapan_id','nilai','periode_bulan','periode_tahun','dinilai_oleh']; public function user(): BelongsTo{return $this->belongsTo(User::class);} public function kecakapan(): BelongsTo{return $this->belongsTo(Kecakapan::class);} public function penilai(): BelongsTo{return $this->belongsTo(User::class,'dinilai_oleh');} }
