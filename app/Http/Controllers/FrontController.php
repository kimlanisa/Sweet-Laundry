<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{transaksi};

class FrontController extends Controller
{
  public function index()
  {
    return view('frontend.index');
  }

  public function search(Request $request)
  {
      $search = transaksi::where('invoice', $request->search_status);
      if ($search->count() == 0) {
          $return = 0;
        }else{
          $return = $search->first();
        }
        return $return;
  }
}
