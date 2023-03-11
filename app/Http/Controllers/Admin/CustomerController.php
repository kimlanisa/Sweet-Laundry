<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class CustomerController extends Controller
{

    public function index()
    {
      $customer = User::where('auth','Customer')->get();
      return view('modul_admin.customer.index', compact('customer'));
    }

    public function show($id)
    {
      $customer = User::with('transaksiCustomer')->where('id',$id)->first();
      return view('modul_admin.customer.infoCustomer', compact('customer'));
    }

    public function edit($id)
    {
      $customer = User::where('id',$id)->first();
      return view('modul_admin.customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
      $customer = User::where('id',$id)->first();
      $customer->name = $request->name;
      $customer->email = $request->email;
      $customer->no_telp = $request->no_telp;
      $customer->alamat = $request->alamat;
      $customer->save();
      return redirect()->route('customer.index')->with('success','Data berhasil diubah');
    }

    public function store (Request $request)
    {
      $customer = new User;
      $customer->name = $request->name;
      $customer->email = $request->email;
      $customer->no_telp = $request->no_telp;
      $customer->alamat = $request->alamat;
      $customer->auth = 'Customer';
      $customer->status = 'Active';
      $customer->save();
      return redirect()->route('customer.index')->with('success','Data berhasil ditambahkan');
    }

    public function destroy($id)
    {
      $customer = User::where('id',$id)->first();
      $customer->delete();
      return redirect()->route('customer.index')->with('success','Data berhasil dihapus');
    }

    public function create()
    {
      return view('modul_admin.customer.create');
    }


}
