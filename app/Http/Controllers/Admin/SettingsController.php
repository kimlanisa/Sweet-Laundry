<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\{PageSettings,User,LaundrySetting,DataBank};

class SettingsController extends Controller
{

  // Settings
  public function setting()
  {
    $settarget  = LaundrySetting::first();
    $data_banks   = DataBank::where('user_id',Auth::id())->get();

    return view('modul_admin.setting.index', compact('settarget','data_banks'));
  }

  // Setting Laundry Target
  public function set_target_laundry(Request $request, $id)
  {
    $set_target = LaundrySetting::findOrFail($id);
    $set_target->target_day = $request->target_day;
    $set_target->target_month = $request->target_month;
    $set_target->target_year = $request->target_year;
    $set_target->save();

    Session::flash('success','Target Berhasil Diupdate !');
    return back();
  }

  // Simpan Bank
  public function bank(Request $request)
  {

    $cek = DataBank::get()->count();
    if ($cek >= 3) {
      Session::flash('error','Maksimal bank hanya 3 !');
      return back();
    }

    $request->validate([
      'nama_bank'   => 'required|unique:data_banks',
      'no_rekening' => 'required|unique:data_banks',
      'no_rekening' => 'required',
    ]);

    DataBank::create([
      'nama_bank'     => $request->nama_bank,
      'no_rekening'   => $request->no_rekening,
      'nama_pemilik'  => $request->nama_pemilik,
      'user_id'       => Auth::id(),
    ]);

    Session::flash('success','Bank Berhasil Ditambah !');
    return back();
  }


}
