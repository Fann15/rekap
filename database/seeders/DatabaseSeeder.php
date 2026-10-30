<?php

namespace Database\Seeders;

use App\Models\{DataPerizinan,JenisIzin,Kecakapan,PenilaianKinerja,User};
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin=User::updateOrCreate(['email'=>'admin@bpbatam.test'],['name'=>'Admin BP Batam','password'=>Hash::make('password'),'role'=>'admin','divisi'=>'Manajemen PTSP','email_verified_at'=>now()]);
        $pegawai=collect([['name'=>'Andi Pratama','email'=>'andi@bpbatam.test','divisi'=>'Perizinan Usaha'],['name'=>'Siti Rahma','email'=>'siti@bpbatam.test','divisi'=>'Perizinan Lahan']])->map(fn($u)=>User::updateOrCreate(['email'=>$u['email']],$u+['password'=>Hash::make('password'),'role'=>'pegawai','email_verified_at'=>now()]));
        $izin=collect([['nama_jenis_izin'=>'Izin Usaha','deskripsi'=>'Layanan perizinan usaha'],['nama_jenis_izin'=>'Izin Lahan','deskripsi'=>'Layanan pertanahan dan lahan'],['nama_jenis_izin'=>'Izin Konstruksi','deskripsi'=>'Layanan konstruksi bangunan']])->map(fn($x)=>JenisIzin::updateOrCreate(['nama_jenis_izin'=>$x['nama_jenis_izin']],$x));
        $skills=collect([['nama_kecakapan'=>'Ketepatan Waktu','deskripsi'=>'Penyelesaian layanan sesuai SLA','bobot_nilai'=>35],['nama_kecakapan'=>'Kualitas Verifikasi','deskripsi'=>'Ketelitian pemeriksaan berkas','bobot_nilai'=>35],['nama_kecakapan'=>'Pelayanan Pemohon','deskripsi'=>'Komunikasi dan pelayanan','bobot_nilai'=>30]])->map(fn($x)=>Kecakapan::updateOrCreate(['nama_kecakapan'=>$x['nama_kecakapan']],$x));
        foreach($pegawai as $n=>$u){foreach(range(1,6) as $i){DataPerizinan::updateOrCreate(['nama_pemohon'=>'Pemohon Dummy '.$n.'-'.$i],['user_id'=>$u->id,'jenis_izin_id'=>$izin[$i%3]->id,'tanggal_pengajuan'=>now()->subDays($i*5)->toDateString(),'tanggal_selesai'=>$i%3?now()->subDays($i*3)->toDateString():null,'status'=>$i%3===0?'proses':($i%4===0?'ditolak':'selesai'),'keterangan'=>'Data contoh untuk pengujian aplikasi','periode_bulan'=>now()->month,'periode_tahun'=>now()->year]);}foreach($skills as $s)PenilaianKinerja::updateOrCreate(['user_id'=>$u->id,'kecakapan_id'=>$s->id,'periode_bulan'=>now()->month,'periode_tahun'=>now()->year],['nilai'=>rand(75,95),'dinilai_oleh'=>$admin->id]);}
    }
}
