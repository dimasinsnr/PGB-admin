<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use \DateTime;
use \DateInterval;

class DokumenController extends Controller
{

    public function index()
    {
        return view('dokumen_kesehatan.index', [
            'title' => 'Dokumen Kesehatan'
        ]);
    }

    public function generateDoc(Request $request)
    {
        // filter should contain anggota_id and periode_pemeriksaan
        $filter = $request->all();

        $currentDate = new DateTime();
        $currentDate->sub(new DateInterval("P{$filter['periode_pemeriksaan']}M"));
        $period = $currentDate->format('Y-m-d');

        $data = DB::table('v_data_kesehatan')
            ->whereBetween('data_kesehatan_pengambilan_tanggal', [$period, (new DateTime)->format('Y-m-d')])
            ->where('data_kesehatan_anggota_id', $filter['anggota_id'])
            ->get()->toArray();
        $dataDiri = (array) DB::table('v_anggota')->where('anggota_id', $filter['anggota_id'])->first();
        // $dataDiri = $dataDiri->toArray();

        $tanggal = [
            'from' => $currentDate->format('d-M-Y'),
            'to' => (new DateTime)->format('d-M-Y')
        ];

        $html = view('dokumen_kesehatan.pdf-temp', [
            'data' => $data,
            'anggota' => $dataDiri,
            'tanggal' => $tanggal
        ]);
        $mpdf = new Mpdf([
            'default_font_size' => 8,
            'default_font' => 'Arial'
        ]);
        $mpdf->useSubstitutions = false;
        $mpdf->simpleTables = true;
        $mpdf->WriteHTML($html);
        $filename = 'Dokumen Kesehatan' . date('Y-m-d-H-i-s') . '.pdf';
        // response()->header('Content-Type', 'application/pdf');
        $mpdf->Output($filename, 'D');
    }

    public function testDoc(Request $request)
    {
        $filter = [
            'anggota_id' => 1231142,
            'periode_pemeriksaan' => 6
        ];

        $currentDate = new DateTime();
        $currentDate->sub(new DateInterval("P{$filter['periode_pemeriksaan']}M"));
        $period = $currentDate->format('Y-m-d');

        $data = DB::table('v_data_kesehatan')
            ->whereBetween('data_kesehatan_pengambilan_tanggal', [$period, (new DateTime)->format('Y-m-d')])
            ->where('data_kesehatan_anggota_id', $filter['anggota_id'])
            ->get()->toArray();
        $dataDiri = (array) DB::table('v_anggota')->where('anggota_id', $filter['anggota_id'])->first();
        // $dataDiri = $dataDiri->toArray();

        $tanggal = [
            'from' => $currentDate->format('d-M-Y'),
            'to' => (new DateTime)->format('d-M-Y')
        ];

        return view('dokumen_kesehatan.pdf-temp', [
            'data' => $data,
            'anggota' => $dataDiri,
            'tanggal' => $tanggal
        ]);
    }
}
