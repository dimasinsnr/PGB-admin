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

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('anggota.index', [
            'title' => 'Data Anggota PGB'
        ]);
    }

    public function initTable()
    {
        return datatables()->of(DB::table('v_anggota')->whereNull('anggota_deleted_at'))
        ->addColumn('action','anggota.ul-action')
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

    public function storeData(Request $request)
    {
        // print_r($request->all());exit;
        try {
            if(!empty($request->anggota_id)) {
                $existingNoAnggota = DB::table('anggotas')
                ->where('anggota_id', '!=', $request->anggota_id)
                ->where('anggota_no_identitas', $request->anggota_no_identitas)
                ->whereNull('anggota_deleted_at')
                ->first();

                if ($existingNoAnggota) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Nomor identitas sudah digunakan oleh anggota lain.'
                    ]);
                } else {
                    if ($request->hasFile('photo')) {
                        // Get file from request
                        $file = $request->file('photo');
                        
                        // Generate unique filename
                        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $name = $filename;
                        
                        // Simpan file ke dalam folder public/img
                        $file->move(public_path('img'), $filename);
                    }
                    
                    $readAnggota = DB::table('anggotas')
                    ->where('anggota_id', $request->anggota_id)
                    ->first();
                    
                    $anggota = get_object_vars($readAnggota);
                    $birthdate = $request->anggota_tgl_lahir;
                    $today = date('Y-m-d');
                    
                    $diff = date_diff(date_create($birthdate), date_create($today));
                    $age = $diff->y;
                    
                    // Melakukan pembaruan data pada arrayanggota_unit_latihan_id
                    $anggota['anggota_unit_latihan_id'] = $request->anggota_unit_latihan_id; 
                    $anggota['anggota_nama'] = $request->anggota_nama; 
                    $anggota['anggota_email'] = $request->anggota_email;
                    $anggota['anggota_tempat_lahir'] = $request->anggota_tempat_lahir;
                    $anggota['anggota_tgl_lahir'] = $request->anggota_tgl_lahir;
                    $anggota['anggota_usia'] = $age;
                    $anggota['anggota_jenis_kelamin'] = $request->anggota_jenis_kelamin;
                    $anggota['anggota_alamat'] = $request->anggota_alamat;
                    $anggota['anggota_jenis_identitas'] = $request->anggota_jenis_identitas;
                    $anggota['anggota_no_identitas'] = $request->anggota_no_identitas;
                    $anggota['anggota_jenis_pekerjaan'] = $request->anggota_jenis_pekerjaan;
                    $anggota['anggota_no_hp'] = $request->anggota_no_hp;
                    $anggota['anggota_gol_darah'] = $request->anggota_gol_darah;
                    $anggota['anggota_catatan_alergi'] = $request->anggota_catatan_alergi;
                    $anggota['anggota_riwayat_sakit'] = $request->anggota_riwayat_sakit;
                    $anggota['anggota_tanggal_mulai'] = $request->anggota_tanggal_mulai;
                    if ($request->hasFile('photo')) {
                        $anggota['anggota_foto'] = $name;
                    }
                    $anggota['anggota_updated_at'] = date('Y-m-d H:i:s');
                    
                    // Simpan perubahan ke dalam database, jika menggunakan Query Builder
                    if ($request->hasFile('photo')) {
                        DB::table('anggotas')
                            ->where('anggota_id', $request->anggota_id)
                            ->update([
                                'anggota_unit_latihan_id' => $anggota['anggota_unit_latihan_id'],
                                'anggota_nama' => $anggota['anggota_nama'],
                                'anggota_email' => $anggota['anggota_email'],
                                'anggota_tempat_lahir' => $anggota['anggota_tempat_lahir'],
                                'anggota_tgl_lahir' => $anggota['anggota_tgl_lahir'],
                                'anggota_usia' => $anggota['anggota_usia'],
                                'anggota_jenis_kelamin' => $anggota['anggota_jenis_kelamin'],
                                'anggota_alamat' => $anggota['anggota_alamat'],
                                'anggota_jenis_identitas' => $anggota['anggota_jenis_identitas'],
                                'anggota_no_identitas' => $anggota['anggota_no_identitas'],
                                'anggota_jenis_pekerjaan' => $anggota['anggota_jenis_pekerjaan'],
                                'anggota_no_hp' => $anggota['anggota_no_hp'],
                                'anggota_gol_darah' => $anggota['anggota_gol_darah'],
                                'anggota_catatan_alergi' => $anggota['anggota_catatan_alergi'],
                                'anggota_riwayat_sakit' => $anggota['anggota_riwayat_sakit'],
                                'anggota_tanggal_mulai' => $anggota['anggota_tanggal_mulai'],
                                'anggota_foto' => $anggota['anggota_foto'],
                                'anggota_updated_at' => $anggota['anggota_updated_at']
                            ]);
                    } else {
                        DB::table('anggotas')
                            ->where('anggota_id', $request->anggota_id)
                            ->update([
                                'anggota_unit_latihan_id' => $anggota['anggota_unit_latihan_id'],
                                'anggota_nama' => $anggota['anggota_nama'],
                                'anggota_email' => $anggota['anggota_email'],
                                'anggota_tempat_lahir' => $anggota['anggota_tempat_lahir'],
                                'anggota_tgl_lahir' => $anggota['anggota_tgl_lahir'],
                                'anggota_usia' => $anggota['anggota_usia'],
                                'anggota_jenis_kelamin' => $anggota['anggota_jenis_kelamin'],
                                'anggota_alamat' => $anggota['anggota_alamat'],
                                'anggota_jenis_identitas' => $anggota['anggota_jenis_identitas'],
                                'anggota_no_identitas' => $anggota['anggota_no_identitas'],
                                'anggota_jenis_pekerjaan' => $anggota['anggota_jenis_pekerjaan'],
                                'anggota_no_hp' => $anggota['anggota_no_hp'],
                                'anggota_gol_darah' => $anggota['anggota_gol_darah'],
                                'anggota_catatan_alergi' => $anggota['anggota_catatan_alergi'],
                                'anggota_riwayat_sakit' => $anggota['anggota_riwayat_sakit'],
                                'anggota_tanggal_mulai' => $anggota['anggota_tanggal_mulai'],
                                'anggota_updated_at' => $anggota['anggota_updated_at']
                            ]);
                    }
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Data Anggota PGB berhasil diperbarui.',
                        'unitLatihan' => $anggota // Mengembalikan data yang diperbarui
                    ]);
                }

            } else {
                $existingNoAnggota = DB::table('anggotas')
                ->where('anggota_id', '!=', $request->anggota_id)
                ->where('anggota_no_identitas', $request->anggota_no_identitas)
                ->whereNull('anggota_deleted_at')
                ->first();

                if ($existingNoAnggota) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Nomor identitas sudah digunakan oleh anggota lain.'
                    ]);
                } else {
                    if ($request->hasFile('photo')) {
                        // Get file from request
                        $file = $request->file('photo');
                        
                        // Generate unique filename
                        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                        $name = $filename;
                        
                        // Simpan file ke dalam folder public/img
                        $file->move(public_path('img'), $filename);
                        $photoUrl = asset('img/' . $filename); // URL file yang disimpan
                    }
    
                    $anggotatId = Uuid::uuid4()->toString();
                    $birthdate = $request->anggota_tgl_lahir;
                    $today = date('Y-m-d');
                    
                    $diff = date_diff(date_create($birthdate), date_create($today));
                    $age = $diff->y;
                    $anggotaPGB = Anggota::create([
                        'anggota_id' => $anggotatId,
                        'anggota_unit_latihan_id' => $request->anggota_unit_latihan_id,
                        'anggota_nama' => $request->anggota_nama,
                        'anggota_email' => $request->anggota_email,
                        'anggota_tempat_lahir' => $request->anggota_tempat_lahir,
                        'anggota_tgl_lahir' => $request->anggota_tgl_lahir,
                        'anggota_usia' => $age,
                        'anggota_jenis_kelamin' => $request->anggota_jenis_kelamin,
                        'anggota_alamat' => $request->anggota_alamat,
                        'anggota_jenis_identitas' => $request->anggota_jenis_identitas,
                        'anggota_no_identitas' => $request->anggota_no_identitas,
                        'anggota_jenis_pekerjaan' => $request->anggota_jenis_pekerjaan,
                        'anggota_no_hp' => $request->anggota_no_hp,
                        'anggota_gol_darah' => $request->anggota_gol_darah,
                        'anggota_catatan_alergi' => $request->anggota_catatan_alergi,
                        'anggota_riwayat_sakit' => $request->anggota_riwayat_sakit,
                        'anggota_tanggal_mulai' => $request->anggota_tanggal_mulai,
                        'anggota_foto' => $name,
                        'anggota_created_at' => date('Y-m-d H:i:s'),
                        'anggota_updated_at' => null,
                        'anggota_deleted_at' => null
                    ]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Data Anggota PGB berhasil disimpan.',
                        'anggota' => $anggotaPGB // Jika ingin mengembalikan data yang baru dibuat
                    ]);
                }
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
            $readAnggota = DB::table('v_anggota')
            ->where('anggota_id', $request->anggota_id)
            ->first();
            
            $anggota = get_object_vars($readAnggota);
            return response()->json([
                'success' => true,
                'message' => 'Data unit latihan berhasil diperbarui.',
                'data' => $anggota // Mengembalikan data yang diperbarui
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gaga show dta anggota.',
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
