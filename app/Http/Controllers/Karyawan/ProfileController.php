<?php

namespace App\Http\Controllers\Karyawan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    // Profile Karyawan
    public function karyawanProfile($id)
    {
      $user = User::find($id);
      return view('karyawan.profile.index', compact('user'));
    }

    // Profile Karyawan Save
    public function karyawanProfileSave(Request $request, $id)
    {
    //   $foto = $request->file('foto');
    //   if ($foto) {
    //     $nama_foto = time()."_".$foto->getClientOriginalName();
    //     $tujuan_upload = 'public/images/foto_profile';
    //     $foto->storeAs($tujuan_upload,$nama_foto);
    //   }

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

      Session::flash('success','Data profile berhasil diupdate !');
      return back();
    }

}
