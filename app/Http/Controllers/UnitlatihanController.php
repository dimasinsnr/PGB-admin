<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\DB;
use App\User;
use App\UnitLatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Ramsey\Uuid\Uuid;

class UnitlatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unitlatihan.index', [
            'title' => 'Data Unit Latihan'
        ]);
    }

    public function initTable()
    {
        // if (request()->ajax()) {
            // return datatables()->of(UnitLatihan::select('*'))
            return datatables()->of(UnitLatihan::select('*')->whereNull('unit_latihan_deleted_at'))
            ->addColumn('action','unitlatihan.ul-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        // }
    }

    public function storeData(Request $request)
    {
        try {
            if(!empty($request->unit_latihan_id)) {
                    $readUnitLatihan = DB::table('unit_latihans')
                    ->where('unit_latihan_id', $request->unit_latihan_id)
                    ->first();
                
                $unitLatihan = get_object_vars($readUnitLatihan);
                
                // Melakukan pembaruan data pada array
                $unitLatihan['unit_latihan_nama'] = $request->unit_name;
                $unitLatihan['unit_latihan_updated_at'] = date('Y-m-d H:i:s');
                
                // Simpan perubahan ke dalam database, jika menggunakan Query Builder
                DB::table('unit_latihans')
                    ->where('unit_latihan_id', $request->unit_latihan_id)
                    ->update([
                        'unit_latihan_nama' => $unitLatihan['unit_latihan_nama'],
                        'unit_latihan_updated_at' => $unitLatihan['unit_latihan_updated_at']
                    ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Data unit latihan berhasil diperbarui.',
                    'unitLatihan' => $unitLatihan // Mengembalikan data yang diperbarui
                ]);
            } else {
                $unitId = Uuid::uuid4()->toString();
                $inc = UnitLatihan::count() + 1;
                $unitKode = 'PGB-' . str_pad($inc, 3, "0", STR_PAD_LEFT);
    
                $unitLatihan = UnitLatihan::create([
                    'unit_latihan_id' => $unitId,
                    'unit_latihan_kode' => $unitKode,
                    'unit_latihan_nama' => $request->unit_name,
                    'unit_latihan_created_at' => date('Y-m-d H:i:s'),
                    'unit_latihan_updated_at' => null,
                    'unit_latihan_deleted_at' => null
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Data unit latihan berhasil disimpan.',
                    'unitLatihan' => $unitLatihan // Jika ingin mengembalikan data yang baru dibuat
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data unit latihan.',
                'error' => $e->getMessage() // Jika ingin menyertakan pesan kesalahan
            ], 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function deleteData(Request $request)
    {
        $readUnitLatihan = DB::table('unit_latihans')
        ->where('unit_latihan_id', $request->unit_latihan_id)
        ->first();
    
        $unitLatihan = get_object_vars($readUnitLatihan);
        
        // Melakukan pembaruan data pada array
        $unitLatihan['unit_latihan_deleted_at'] = date('Y-m-d H:i:s');
        
        // Simpan perubahan ke dalam database, jika menggunakan Query Builder
        DB::table('unit_latihans')
            ->where('unit_latihan_id', $request->unit_latihan_id)
            ->update([
                'unit_latihan_deleted_at' => $unitLatihan['unit_latihan_deleted_at']
            ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Data unit latihan berhasil diperbarui.',
            'unitLatihan' => $unitLatihan // Mengembalikan data yang diperbarui
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, User $basic)
    {
        if($request->filled('password')) {
            $basic->password = Hash::make($request->password);
        }
        $basic->name = $request->name;
        $basic->last_name = $request->last_name;
        $basic->email = $request->email;
        $basic->save();

        return redirect()->route('basic.index')->with('message', 'User updated successfully!');
    }
}
