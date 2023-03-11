<?php

namespace App\Http\Controllers\Admin;

use Rupiah;
use Carbon\carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // Halaman admin
    public function adm()
    {
      $adm = User::where('auth','Admin')->get();
      return view('modul_admin.pengguna.admin', compact('adm'));
    }

    // Profile
    public function profile()
    {
      $profile = User::where('id',Auth::id())->first();
      return view('modul_admin.setting.profile', compact('profile'));
    }

    // Update Profile
    public function adminProfileSave(Request $request, $id)
    {
        $foto = $request->file('foto');
        if ($foto) {
            $nama_foto = time() . "_" . $foto->getClientOriginalName();
            $tujuan_upload = 'public/images/foto_profile';
            $foto->storeAs($tujuan_upload, $nama_foto);
        }

        if ($request->password) {
            $password = Hash::make($request->password);
        }
        $phone_number = preg_replace('/^0/', '62', $request->no_telp);
        $profile = User::findOrFail($id);
        $profile->name            = $request->name;
        $profile->email           = $request->email;
        $profile->alamat          = $request->alamat;
        $profile->no_telp         = $phone_number;
        $profile->foto            = $nama_foto ?? Auth::user()->foto;
        $profile->password        = $password ?? Auth::user()->password;
        $profile->save();

        Session::flash('success', 'Data profile berhasil diupdate !');
        return back();
    }

}
