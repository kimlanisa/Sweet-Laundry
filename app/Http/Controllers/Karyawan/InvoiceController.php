<?php

namespace App\Http\Controllers\Karyawan;

use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{transaksi,DataBank};
use Illuminate\Support\Facades\Auth;
class InvoiceController extends Controller
{
       // Invoice
    public function invoicekar(Request $request)
    {
      $invoice = transaksi::with('price')
      ->where('user_id',Auth::id())
      ->where('id',$request->id)
      ->get();

      $data = transaksi::with('customers','user')
      ->where('user_id',Auth::id())
      ->where('id',$request->id)
      ->first();

      $data_banks = DataBank::get();
      return view('karyawan.laporan.invoice', compact('invoice','data','data_banks'));
    }

    // Cetak invoice
    public function cetakinvoice(Request $request)
    {
       $invoice = transaksi::with('price')
      ->where('user_id',Auth::id())
      ->where('id',$request->id)
      ->get();

      $data = transaksi::with('customers','user')
      ->where('user_id',Auth::id())
      ->where('id',$request->id)
      ->first();

      $data_banks = DataBank::get();

      $pdf = PDF::loadView('karyawan.laporan.cetak', compact('invoice','data','data_banks'))->setPaper('a4', 'landscape');
      return $pdf->stream();
    }
}
