<?php

namespace App\Http\Controllers;

// use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// use App\User;
use App\UnitLatihan;
use App\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Ramsey\Uuid\Uuid;

class DatakesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('datakesehatan.index', [
            'title' => 'Data Kesehatan Anggota PGB'
        ]);
    }

    public function initTable()
    {
        return datatables()->of(DB::table('v_data_kesehatan'))
        ->addColumn('action','datakesehatan.ul-action')
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }

    public function comboUnitLatihan()
    {
        $unitLatihans = DB::table('unit_latihans')
        ->whereNull('unit_latihan_deleted_at')
        ->get();
        // print_r($unitLatihans);exit;
        $response = [
            "success" => true,
            "code" => 200,
            "message" => "Successfully get Data",
            "error" => [],
            "data" => $unitLatihans
        ];

        return response()->json($response);
    }

    public function comboAnggota()
    {
        $anggota = DB::table('anggotas')
        ->whereNull('anggota_deleted_at')
        ->get();
        // print_r($unitLatihans);exit;
        $response = [
            "success" => true,
            "code" => 200,
            "message" => "Successfully get Data",
            "error" => [],
            "data" => $anggota
        ];

        return response()->json($response);
    }

    public function storeData(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        // print_r($request->all());exit;
        try {
            if(!empty($request->data_kesehatan_id)) {
                $readDataKesehatan = DB::table('data_kesehatans')
                ->where('data_kesehatan_id', $request->data_kesehatan_id)
                ->first();
            
                $dataKesehatan = get_object_vars($readDataKesehatan);
                
                // Fields to update
                $fieldsToUpdate = [
                    'data_kesehatan_pengambilan_tanggal',
                    'data_kesehatan_unit_latihan_id',
                    'data_kesehatan_updated_at',
                    'tinggi_badan',
                    'berat_badan',
                    'lingkar_pinggang',
                    'lingkar_pinggul',
                    'lingkar_dada',
                    'lingkar_leher',
                    'indeks_masa_tubuh',
                    'ob_ratio_tinggi_pinggang',
                    'ob_ratio_pinggang_pinggul',
                    'persen_lemak_tubuh',
                    'tingkat_metabolisme_basal',
                    'laju_pernafasan_permenit',
                    'systol_awal',
                    'dyastol_awal',
                    'dnm_awal',
                    'systol_pasca',
                    'dyastol_pasca',
                    'dnm_pasca',
                    'gula_darah',
                    'kolestrol',
                    'asam_urat',
                    'balancing_left_matatutup',
                    'balancing_right_matatutup',
                    'balancing_left_jinjit',
                    'balancing_right_jinjit',
                    'sit_reach_2legs',
                    'sit_reach_leftstraight',
                    'sit_reach_rightstraight',
                    'backrise',
                    'agility_heks_left',
                    'agility_heks_right',
                    'pushup',
                    'situp',
                    'vertical_jump',
                    'pullup',
                    'shuttle_run',
                    'run_60meter',
                ];
                
                // Membuat data yang ingin diupdate
                $dataToUpdate = [
                    'data_kesehatan_updated_at' => date('Y-m-d H:i:s'),
                ];
                
                // Iterate over fields and update $dataToUpdate
                foreach ($fieldsToUpdate as $field) {
                    if ($request->has($field)) {
                        $dataToUpdate[$field] = $request->$field;
                    }
                }
                if ($request->has('systol_awal')) {
                    $dataToUpdate['data_keshatan_tanda_vital'] = 1;
                }
                if ($request->has('gula_darah')) {
                    $dataToUpdate['data_keshatan_gula_darah'] = 1;
                }
                if ($request->has('kolestrol')) {
                    $dataToUpdate['data_keshatan_kolestrol'] = 1;
                }
                if ($request->has('tinggi_badan')) {
                    $readJk = DB::table('anggotas')
                    ->where('anggota_id', $request->data_kesehatan_anggota_id)
                    ->first();
                    $anggotaJk = get_object_vars($readJk);

                    $tinggiBadanMeter = $request->tinggi_badan / 100;
                    $pinggangLeherLog = log($request->lingkar_pinggang - $request->lingkar_leher);
                    $pinggangPinggulLeherLog = log($request->lingkar_pinggang + $request->lingkar_pinggul - $request->lingkar_leher);
                    $tinggiLog = log($request->tinggi_badan);

                    $dataToUpdate['data_keshatan_komponen_fisik'] = 1;
                    $dataToUpdate['indeks_masa_tubuh'] = $request->berat_badan / ($tinggiBadanMeter * $tinggiBadanMeter);
                    $dataToUpdate['ob_ratio_tinggi_pinggang'] = $request->lingkar_pinggang / $request->tinggi_badan;
                    $dataToUpdate['ob_ratio_pinggang_pinggul'] = $request->lingkar_pinggang / $request->lingkar_pinggul;
                    if ($anggotaJk['anggota_jenis_kelamin'] == 1) {
                        // Pria
                        $dataToUpdate['persen_lemak_tubuh'] = 495 / (1.0324 - 0.19077 * $pinggangLeherLog + 0.15456 * $tinggiLog) - 450;
                    } else {
                        // Wanita
                        $dataToUpdate['persen_lemak_tubuh'] = 495 / (1.29579 - 0.35004 * $pinggangPinggulLeherLog + 0.22100 * $tinggiLog) - 450;;
                    }
                    if ($anggotaJk['anggota_jenis_kelamin'] == 1) {
                        // Pria
                        $dataToUpdate['tingkat_metabolisme_basal'] = 66 + (13.7 * $request->berat_badan) + (5 * $request->tinggi_badan) - (6.8 * $anggotaJk['anggota_usia']);
                    } else {
                        // Wanita
                        $dataToUpdate['tingkat_metabolisme_basal'] = 655 + (9.6 * $request->berat_badan) + (1.8 * $request->tinggi_badan) - (4.7 * $anggotaJk['anggota_usia']);
                    }
                }
                if ($request->has('balancing_left_matatutup')) {
                    $dataToUpdate['data_keshatan_kebugaran_jasmani'] = 1;
                }
                if ($request->has('asam_urat')) {
                    $dataToUpdate['data_keshatan_asam_urat'] = 1;
                }
                DB::table('data_kesehatans')->where('data_kesehatan_id', $request->data_kesehatan_id)->update($dataToUpdate);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Data Kesehatan berhasil diperbarui.',
                ]);
            
            } else {
                $dataKesehatanId = Uuid::uuid4()->toString();

                $fieldsToStore = [
                    'tinggi_badan', 'berat_badan', 'lingkar_pinggang', 'lingkar_pinggul',
                    'lingkar_dada', 'lingkar_leher', 'indeks_masa_tubuh', 'ob_ratio_tinggi_pinggang',
                    'ob_ratio_pinggang_pinggul', 'persen_lemak_tubuh', 'tingkat_metabolisme_basal',
                    'laju_pernafasan_permenit', 'systol_awal', 'dyastol_awal', 'dnm_awal',
                    'systol_pasca', 'dyastol_pasca', 'dnm_pasca', 'gula_darah', 'kolestrol',
                    'asam_urat', 'balancing_left_matatutup', 'balancing_right_matatutup',
                    'balancing_left_jinjit', 'balancing_right_jinjit', 'sit_reach_2legs',
                    'sit_reach_leftstraight', 'sit_reach_rightstraight', 'backrise',
                    'agility_heks_left', 'agility_heks_right', 'pushup', 'situp', 'vertical_jump',
                    'pullup', 'shuttle_run', 'run_60meter',
                ];
                
                $dataToStore = [
                    'data_kesehatan_id' => $dataKesehatanId,
                    'data_kesehatan_anggota_id' => $request->data_kesehatan_anggota_id,
                    'data_kesehatan_pengambilan_tanggal' => $request->data_kesehatan_pengambilan_tanggal,
                    'data_kesehatan_unit_latihan_id' => $request->data_kesehatan_unit_latihan_id,
                    'data_kesehatan_created_at' => now()->toDateTimeString(),
                ];
                
                foreach ($fieldsToStore as $field) {
                    if ($request->has($field)) {
                        $dataToStore[$field] = $request->$field;
                    }
                }
                if ($request->has('systol_awal')) {
                    $dataToStore['data_keshatan_tanda_vital'] = 1;
                }
                if ($request->has('gula_darah')) {
                    $dataToStore['data_keshatan_gula_darah'] = 1;
                }
                if ($request->has('kolestrol')) {
                    $dataToStore['data_keshatan_kolestrol'] = 1;
                }
                if ($request->has('tinggi_badan')) {
                    $readJk = DB::table('anggotas')
                    ->where('anggota_id', $request->data_kesehatan_anggota_id)
                    ->first();
                    $anggotaJk = get_object_vars($readJk);

                    $tinggiBadanMeter = $request->tinggi_badan / 100;
                    $pinggangLeherLog = log($request->lingkar_pinggang - $request->lingkar_leher);
                    $pinggangPinggulLeherLog = log($request->lingkar_pinggang + $request->lingkar_pinggul - $request->lingkar_leher);
                    $tinggiLog = log($request->tinggi_badan);

                    $dataToStore['data_keshatan_komponen_fisik'] = 1;
                    $dataToStore['indeks_masa_tubuh'] = $request->berat_badan / ($tinggiBadanMeter * $tinggiBadanMeter);
                    $dataToStore['ob_ratio_tinggi_pinggang'] = $request->lingkar_pinggang / $request->tinggi_badan;
                    $dataToStore['ob_ratio_pinggang_pinggul'] = $request->lingkar_pinggang / $request->lingkar_pinggul;
                    if ($anggotaJk['anggota_jenis_kelamin'] == 1) {
                        // Pria
                        $dataToStore['persen_lemak_tubuh'] = 495 / (1.0324 - 0.19077 * $pinggangLeherLog + 0.15456 * $tinggiLog) - 450;
                    } else {
                        // Wanita
                        $dataToStore['persen_lemak_tubuh'] = 495 / (1.29579 - 0.35004 * $pinggangPinggulLeherLog + 0.22100 * $tinggiLog) - 450;;
                    }
                    if ($anggotaJk['anggota_jenis_kelamin'] == 1) {
                        // Pria
                        $dataToStore['tingkat_metabolisme_basal'] = 66 + (13.7 * $request->berat_badan) + (5 * $request->tinggi_badan) - (6.8 * $anggotaJk['anggota_usia']);
                    } else {
                        // Wanita
                        $dataToStore['tingkat_metabolisme_basal'] = 655 + (9.6 * $request->berat_badan) + (1.8 * $request->tinggi_badan) - (4.7 * $anggotaJk['anggota_usia']);
                    }
                }
                if ($request->has('balancing_left_matatutup')) {
                    $dataToStore['data_keshatan_kebugaran_jasmani'] = 1;
                }
                if ($request->has('asam_urat')) {
                    $dataToStore['data_keshatan_asam_urat'] = 1;
                }
                DB::table('data_kesehatans')->insert($dataToStore);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Data Kesehatan berhasil disimpan.',
                ]);
                
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data Anggota.',
                'error' => $e->getMessage() // Jika ingin menyertakan pesan kesalahan
            ], 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function deleteData(Request $request)
    {
        $readAnggota = DB::table('anggotas')
        ->where('anggota_id', $request->anggota_id)
        ->first();
    
        $anggota = get_object_vars($readAnggota);
        
        // Melakukan pembaruan data pada array
        $anggota['anggota_deleted_at'] = date('Y-m-d H:i:s');
        
        // Simpan perubahan ke dalam database, jika menggunakan Query Builder
        DB::table('anggotas')
            ->where('anggota_id', $request->anggota_id)
            ->update([
                'anggota_deleted_at' => $anggota['anggota_deleted_at']
            ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Data anggota berhasil dihapus .',
            'anggota' => $anggota // Mengembalikan data yang diperbarui
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showData(Request $request)
    {
        try {
            $readDataKesehatan = DB::table('v_data_kesehatan')
            ->where('data_kesehatan_id', $request->datakesehatan_id)
            ->first();
            
            $dataKesehatan = get_object_vars($readDataKesehatan);
            return response()->json([
                'success' => true,
                'message' => 'Shown Data Kesehatan berhasil.',
                'data' => $dataKesehatan // Mengembalikan data yang diperbarui
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal show data kesehatan.',
                'error' => $e->getMessage() // Jika ingin menyertakan pesan kesalahan
            ], 500); // Kode status 500 untuk kesalahan server
        }
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(EditUserRequest $request, User $basic)
    // {
    //     if($request->filled('password')) {
    //         $basic->password = Hash::make($request->password);
    //     }
    //     $basic->name = $request->name;
    //     $basic->last_name = $request->last_name;
    //     $basic->email = $request->email;
    //     $basic->save();

    //     return redirect()->route('basic.index')->with('message', 'User updated successfully!');
    // }
}