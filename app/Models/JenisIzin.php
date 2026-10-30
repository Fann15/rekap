<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model; use Illuminate\Database\Eloquent\Relations\HasMany;
class JenisIzin extends Model { protected $table='jenis_izin'; protected $fillable=['nama_jenis_izin','deskripsi']; public function dataPerizinan(): HasMany { return $this->hasMany(DataPerizinan::class); } }
