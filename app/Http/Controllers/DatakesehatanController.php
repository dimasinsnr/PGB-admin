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

                // Membuat data yang ingin diupdate
                $dataToUpdate = [
                    'data_kesehatan_pengambilan_tanggal' => $request->data_kesehatan_pengambilan_tanggal,
                    'data_kesehatan_unit_latihan_id' => $request->data_kesehatan_unit_latihan_id,
                    'data_kesehatan_updated_at' => date('Y-m-d H:i:s'),
                ];

                if ($request->has('tinggi_badan')) {
                    $dataToUpdate['tinggi_badan'] = $request->tinggi_badan;
                }
                if ($request->has('berat_badan')) {
                    $dataToUpdate['berat_badan'] = $request->berat_badan;
                }
                if ($request->has('lingkar_pinggang')) {
                    $dataToUpdate['lingkar_pinggang'] = $request->lingkar_pinggang;
                }
                if ($request->has('lingkar_pinggul')) {
                    $dataToUpdate['lingkar_pinggul'] = $request->lingkar_pinggul;
                }
                if ($request->has('lingkar_dada')) {
                    $dataToUpdate['lingkar_dada'] = $request->lingkar_dada;
                }
                if ($request->has('lingkar_leher')) {
                    $dataToUpdate['lingkar_leher'] = $request->lingkar_leher;
                }
                if ($request->has('indeks_masa_tubuh')) {
                    $dataToUpdate['indeks_masa_tubuh'] = $request->indeks_masa_tubuh;
                }
                if ($request->has('ob_ratio_tinggi_pinggang')) {
                    $dataToUpdate['ob_ratio_tinggi_pinggang'] = $request->ob_ratio_tinggi_pinggang;
                }
                if ($request->has('ob_ratio_pinggang_pinggul')) {
                    $dataToUpdate['ob_ratio_pinggang_pinggul'] = $request->ob_ratio_pinggang_pinggul;
                }
                if ($request->has('persen_lemak_tubuh')) {
                    $dataToUpdate['persen_lemak_tubuh'] = $request->persen_lemak_tubuh;
                }
                if ($request->has('tingkat_metabolisme_basal')) {
                    $dataToUpdate['tingkat_metabolisme_basal'] = $request->tingkat_metabolisme_basal;
                }
                if ($request->has('laju_pernafasan_permenit')) {
                    $dataToUpdate['laju_pernafasan_permenit'] = $request->laju_pernafasan_permenit;
                }
                if ($request->has('systol_awal')) {
                    $dataToUpdate['systol_awal'] = $request->systol_awal;
                }
                if ($request->has('dyastol_awal')) {
                    $dataToUpdate['dyastol_awal'] = $request->dyastol_awal;
                }
                if ($request->has('dnm_awal')) {
                    $dataToUpdate['dnm_awal'] = $request->dnm_awal;
                }
                if ($request->has('systol_pasca')) {
                    $dataToUpdate['systol_pasca'] = $request->systol_pasca;
                }
                if ($request->has('dyastol_pasca')) {
                    $dataToUpdate['dyastol_pasca'] = $request->dyastol_pasca;
                }
                if ($request->has('dnm_pasca')) {
                    $dataToUpdate['dnm_pasca'] = $request->dnm_pasca;
                }
                if ($request->has('gula_darah')) {
                    $dataToUpdate['gula_darah'] = $request->gula_darah;
                }
                if ($request->has('kolestrol')) {
                    $dataToUpdate['kolestrol'] = $request->kolestrol;
                }
                if ($request->has('asam_urat')) {
                    $dataToUpdate['asam_urat'] = $request->asam_urat;
                }
                if ($request->has('balancing_left_matatutup')) {
                    $dataToUpdate['balancing_left_matatutup'] = $request->balancing_left_matatutup;
                }
                if ($request->has('balancing_right_matatutup')) {
                    $dataToUpdate['balancing_right_matatutup'] = $request->balancing_right_matatutup;
                }
                if ($request->has('balancing_left_jinjit')) {
                    $dataToUpdate['balancing_left_jinjit'] = $request->balancing_left_jinjit;
                }
                if ($request->has('balancing_right_jinjit')) {
                    $dataToUpdate['balancing_right_jinjit'] = $request->balancing_right_jinjit;
                }
                if ($request->has('sit_reach_2legs')) {
                    $dataToUpdate['sit_reach_2legs'] = $request->sit_reach_2legs;
                }
                if ($request->has('sit_reach_leftstraight')) {
                    $dataToUpdate['sit_reach_leftstraight'] = $request->sit_reach_leftstraight;
                }
                if ($request->has('sit_reach_rightstraight')) {
                    $dataToUpdate['sit_reach_rightstraight'] = $request->sit_reach_rightstraight;
                }
                if ($request->has('backrise')) {
                    $dataToUpdate['backrise'] = $request->backrise;
                }
                if ($request->has('agility_heks_left')) {
                    $dataToUpdate['agility_heks_left'] = $request->agility_heks_left;
                }
                if ($request->has('agility_heks_right')) {
                    $dataToUpdate['agility_heks_right'] = $request->agility_heks_right;
                }
                if ($request->has('pushup')) {
                    $dataToUpdate['pushup'] = $request->pushup;
                }
                if ($request->has('situp')) {
                    $dataToUpdate['situp'] = $request->situp;
                }
                if ($request->has('vertical_jump')) {
                    $dataToUpdate['vertical_jump'] = $request->vertical_jump;
                }
                if ($request->has('pullup')) {
                    $dataToUpdate['pullup'] = $request->pullup;
                }
                if ($request->has('shuttle_run')) {
                    $dataToUpdate['shuttle_run'] = $request->shuttle_run;
                }
                if ($request->has('run_60meter')) {
                    $dataToUpdate['run_60meter'] = $request->run_60meter;
                }

                DB::table('data_kesehatans')->where('data_kesehatan_id', $request->data_kesehatan_id)->update($dataToUpdate);

                return response()->json([
                    'success' => true,
                    'message' => 'Data Kesehatan berhasil diperbarui.',
                ]);
            } else {
                $dataKesehatanId = Uuid::uuid4()->toString();
                $dataToStore = [
                    'data_kesehatan_id' => $dataKesehatanId,
                    'data_kesehatan_anggota_id' => $request->data_kesehatan_anggota_id,
                    'data_kesehatan_pengambilan_tanggal' => $request->data_kesehatan_pengambilan_tanggal,
                    'data_kesehatan_unit_latihan_id' => $request->data_kesehatan_unit_latihan_id,
                    'data_kesehatan_created_at' => date('Y-m-d H:i:s'),
                ];
                if ($request->has('tinggi_badan')) {
                    $dataToStore['tinggi_badan'] = $request->tinggi_badan;
                }
                if ($request->has('berat_badan')) {
                    $dataToStore['berat_badan'] = $request->berat_badan;
                }
                if ($request->has('lingkar_pinggang')) {
                    $dataToStore['lingkar_pinggang'] = $request->lingkar_pinggang;
                }
                if ($request->has('lingkar_pinggul')) {
                    $dataToStore['lingkar_pinggul'] = $request->lingkar_pinggul;
                }
                if ($request->has('lingkar_dada')) {
                    $dataToStore['lingkar_dada'] = $request->lingkar_dada;
                }
                if ($request->has('lingkar_leher')) {
                    $dataToStore['lingkar_leher'] = $request->lingkar_leher;
                }
                if ($request->has('indeks_masa_tubuh')) {
                    $dataToStore['indeks_masa_tubuh'] = $request->indeks_masa_tubuh;
                }
                if ($request->has('ob_ratio_tinggi_pinggang')) {
                    $dataToStore['ob_ratio_tinggi_pinggang'] = $request->ob_ratio_tinggi_pinggang;
                }
                if ($request->has('ob_ratio_pinggang_pinggul')) {
                    $dataToStore['ob_ratio_pinggang_pinggul'] = $request->ob_ratio_pinggang_pinggul;
                }
                if ($request->has('persen_lemak_tubuh')) {
                    $dataToStore['persen_lemak_tubuh'] = $request->persen_lemak_tubuh;
                }
                if ($request->has('tingkat_metabolisme_basal')) {
                    $dataToStore['tingkat_metabolisme_basal'] = $request->tingkat_metabolisme_basal;
                }
                if ($request->has('laju_pernafasan_permenit')) {
                    $dataToStore['laju_pernafasan_permenit'] = $request->laju_pernafasan_permenit;
                }
                if ($request->has('systol_awal')) {
                    $dataToStore['systol_awal'] = $request->systol_awal;
                }
                if ($request->has('dyastol_awal')) {
                    $dataToStore['dyastol_awal'] = $request->dyastol_awal;
                }
                if ($request->has('dnm_awal')) {
                    $dataToStore['dnm_awal'] = $request->dnm_awal;
                }
                if ($request->has('systol_pasca')) {
                    $dataToStore['systol_pasca'] = $request->systol_pasca;
                }
                if ($request->has('dyastol_pasca')) {
                    $dataToStore['dyastol_pasca'] = $request->dyastol_pasca;
                }
                if ($request->has('dnm_pasca')) {
                    $dataToStore['dnm_pasca'] = $request->dnm_pasca;
                }
                if ($request->has('gula_darah')) {
                    $dataToStore['gula_darah'] = $request->gula_darah;
                }
                if ($request->has('kolestrol')) {
                    $dataToStore['kolestrol'] = $request->kolestrol;
                }
                if ($request->has('asam_urat')) {
                    $dataToStore['asam_urat'] = $request->asam_urat;
                }
                if ($request->has('balancing_left_matatutup')) {
                    $dataToStore['balancing_left_matatutup'] = $request->balancing_left_matatutup;
                }
                if ($request->has('balancing_right_matatutup')) {
                    $dataToStore['balancing_right_matatutup'] = $request->balancing_right_matatutup;
                }
                if ($request->has('balancing_left_jinjit')) {
                    $dataToStore['balancing_left_jinjit'] = $request->balancing_left_jinjit;
                }
                if ($request->has('balancing_right_jinjit')) {
                    $dataToStore['balancing_right_jinjit'] = $request->balancing_right_jinjit;
                }
                if ($request->has('sit_reach_2legs')) {
                    $dataToStore['sit_reach_2legs'] = $request->sit_reach_2legs;
                }
                if ($request->has('sit_reach_leftstraight')) {
                    $dataToStore['sit_reach_leftstraight'] = $request->sit_reach_leftstraight;
                }
                if ($request->has('sit_reach_rightstraight')) {
                    $dataToStore['sit_reach_rightstraight'] = $request->sit_reach_rightstraight;
                }
                if ($request->has('backrise')) {
                    $dataToStore['backrise'] = $request->backrise;
                }
                if ($request->has('agility_heks_left')) {
                    $dataToStore['agility_heks_left'] = $request->agility_heks_left;
                }
                if ($request->has('agility_heks_right')) {
                    $dataToStore['agility_heks_right'] = $request->agility_heks_right;
                }
                if ($request->has('pushup')) {
                    $dataToStore['pushup'] = $request->pushup;
                }
                if ($request->has('situp')) {
                    $dataToStore['situp'] = $request->situp;
                }
                if ($request->has('vertical_jump')) {
                    $dataToStore['vertical_jump'] = $request->vertical_jump;
                }
                if ($request->has('pullup')) {
                    $dataToStore['pullup'] = $request->pullup;
                }
                if ($request->has('shuttle_run')) {
                    $dataToStore['shuttle_run'] = $request->shuttle_run;
                }
                if ($request->has('run_60meter')) {
                    $dataToStore['run_60meter'] = $request->run_60meter;
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