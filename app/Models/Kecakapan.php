<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model; use Illuminate\Database\Eloquent\Relations\HasMany;
class Kecakapan extends Model { protected $table='kecakapan'; protected $fillable=['nama_kecakapan','deskripsi','bobot_nilai']; public function penilaianKinerja(): HasMany{return $this->hasMany(PenilaianKinerja::class);} }
