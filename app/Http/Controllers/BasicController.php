<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class BasicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('basic.list', [
            'title' => 'Data User',
        ]);
    }

    public function initTable()
    {
        return datatables()->of(DB::table('users')->whereNull('deleted_at'))
        ->addColumn('action','basic.ul-action')
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('basic.create', [
    //         'title' => 'New User',
    //         'users' => User::paginate(10)
    //     ]);
    // }

    public function storeData(Request $request, User $basicc)
    {
        try {
            if(!empty($request->id)) {
                $basic = User::find($request->id); // Ganti dengan cara yang sesuai untuk mendapatkan user
                // if($request->filled('password')) {
                //     $basic->password = Hash::make($request->password);
                // }
                $basic->name = $request->name;
                $basic->last_name = $request->last_name;
                if ($request->email != $basic->email) {
                    $basic->email = $request->email;
                }
                $editUser = $basic->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Data User berhasil diperbarui.',
                    'user' => $editUser // Mengembalikan data yang diperbarui
                ]);
            } else {
                $addUser = User::create([
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Data User berhasil disimpan.',
                    'user' => $addUser // Jika ingin mengembalikan data yang baru dibuat
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data User.',
                'error' => $e->getMessage() // Jika ingin menyertakan pesan kesalahan
            ], 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function showData(Request $request)
    {
        try {
            $readUser = DB::table('users')
            ->where('id', $request->id)
            ->first();
            
            $user = get_object_vars($readUser);
            return response()->json([
                'success' => true,
                'message' => 'Data User berhasil diperbarui.',
                'data' => $user // Mengembalikan data yang diperbarui
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal show data User.',
                'error' => $e->getMessage() // Jika ingin menyertakan pesan kesalahan
            ], 500); // Kode status 500 untuk kesalahan server
        }
    }

    public function deleteData(Request $request)
    {
        $readUsers = DB::table('users')
        ->where('id', $request->id)
        ->first();
    
        $user = get_object_vars($readUsers);
        
        // Melakukan pembaruan data pada array
        $user['deleted_at'] = date('Y-m-d H:i:s');
        
        // Simpan perubahan ke dalam database, jika menggunakan Query Builder
        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'deleted_at' => $user['deleted_at']
            ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil dihapus .',
            'user' => $user // Mengembalikan data yang diperbarui
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(AddUserRequest $request)
    // {
    //     User::create([
    //         'name' => $request->name,
    //         'last_name' => $request->last_name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password)
    //     ]);

    //     return redirect()->route('basic.index')->with('message', 'User added successfully!');
    // }

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(User $basic)
    // {
    //     return view('basic.edit', [
    //         'title' => 'Edit User',
    //         'user' => $basic
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(User $basic)
    // {
    //     if (Auth::id() == $basic->getKey()) {
    //         return redirect()->route('basic.index')->with('warning', 'Can not delete yourself!');
    //     }

    //     $basic->delete();

    //     return redirect()->route('basic.index')->with('message', 'User deleted successfully!');
    // }
}
