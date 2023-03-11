<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AddKaryawanRequest;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kry = User::where('auth', 'Karyawan')->get();
        return view('modul_admin.pengguna.kry', compact('kry'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modul_admin.pengguna.addkry');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddKaryawanRequest $request)
    {
        $phone_number = preg_replace('/^0/', '62', $request->no_telp);
        $adduser = new User();
        $adduser->name          = $request->name;
        $adduser->email         = $request->email;
        $adduser->alamat        = $request->alamat;
        $adduser->no_telp       = $phone_number;
        $adduser->status        = 'Active';
        $adduser->auth          = 'Karyawan';
        $adduser->password      = Hash::make($request->password);
        $adduser->save();

        $adduser->assignRole($adduser->auth);

        Session::flash('success', 'Karyawan Berhasil Dibuat.');
        return redirect('karyawan');
    }

    // Update Status Karyawan
    public function updateKaryawan(Request $request)
    {
        $karyawan = User::find($request->id);
        $karyawan->update([
            'status'  => $karyawan->status == 'Active' ? 'Not Active' : 'Active'
        ]);

        Session::flash('success', 'Status Karyawan Berhasil Diupdate.');
    }

    // Delete Karyawan
    public function destroy($id)
    {
        $karyawan = User::where('id', $id)->first();
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('success', 'Data berhasil dihapus');
    }

    // Edit Karyawan
    public function edit($id)
    {
        $karyawan = User::where('id', $id)->first();
        return view('modul_admin.pengguna.editkry', compact('karyawan'));
    }

    // Update Karyawan
    public function update(Request $request, $id)
    {
        $karyawan = User::where('id', $id)->first();
        $karyawan->name = $request->name;
        $karyawan->email = $request->email;
        $karyawan->no_telp = $request->no_telp;
        $karyawan->alamat = $request->alamat;
        $karyawan->save();
        return redirect()->route('karyawan.index')->with('success', 'Data berhasil diubah');
    }
}
