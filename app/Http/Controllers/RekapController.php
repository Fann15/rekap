<?php
namespace App\Http\Controllers;
use App\Models\{DataPerizinan,JenisIzin,User}; use Illuminate\Http\Request;
class RekapController extends Controller { public function index(Request $r){$q=$this->filtered($r)->with(['user','jenisIzin'])->latest();return view('rekap.index',['data'=>$q->paginate(20)->withQueryString(),'users'=>User::where('role','pegawai')->orderBy('name')->get(),'jenisIzins'=>JenisIzin::orderBy('nama_jenis_izin')->get()]);} public function filtered(Request $r){$q=DataPerizinan::query();foreach(['periode_bulan','periode_tahun','user_id','jenis_izin_id','status'] as $f)if($r->filled($f))$q->where($f,$r->$f);return $q;} }
