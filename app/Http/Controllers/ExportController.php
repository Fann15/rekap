<?php
namespace App\Http\Controllers;
use App\Exports\RekapPerizinanExport; use App\Http\Controllers\RekapController; use Barryvdh\DomPDF\Facade\Pdf; use Illuminate\Http\Request; use Maatwebsite\Excel\Facades\Excel;
class ExportController extends Controller { private function filters(Request $r):array{return $r->only(['periode_bulan','periode_tahun','user_id','jenis_izin_id','status']);} public function excel(Request $r){return Excel::download(new RekapPerizinanExport($this->filters($r)),'rekap-perizinan.xlsx');} public function pdf(Request $r){$data=(new RekapController)->filtered($r)->with(['user','jenisIzin'])->latest()->get();return Pdf::loadView('exports.rekap-pdf',compact('data'))->setPaper('a4','landscape')->download('rekap-perizinan.pdf');} }
