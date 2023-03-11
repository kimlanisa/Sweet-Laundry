@extends('layouts.backend')
@section('title','Karyawan - Invoice Customer')
@section('header','Invoice Customer')
@section('content')
<div class="col-md-12">
    <div class="card card-body printableArea">
        <h3><b>INVOICE</b> <span class="pull-right">{{$data->invoice}}</span></h3>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <address>
                        <h3> &nbsp;<b class="text-primary">Sweet Laundry</b></h3>
                        <p class="text-muted m-l-5"> Dilayani Oleh <span style="margin-left:20px"> </span>: {{$data->user->name}}
                            <br/> No. Telp <span style="margin-left:59px"> </span>: {{$data->user->no_telp}}
                            </p>
                    </address>
                </div>
                <div class="pull-right text-right">
                    <address>
                        <h3>Detail Order Customer :</h3>
                        <p class="text-muted m-l-30">
                            {{$data->customers->name}}
                            <br/> {{$data->customers->alamat}}
                            <br/> {{$data->customers->no_telp}}</p>
                        <p class="m-t-30"><b>Tanggal Masuk :</b> <i class="fa fa-calendar"></i> {{carbon\carbon::parse($data->tgl_transaksi)->format('d-m-Y')}}</p>
                        <p><b>Tanggal Diambil :</b> <i class="fa fa-calendar"></i>
                            {{\carbon\carbon::parse($data->tgl_ambil)->format('d-m-Y')}}
                        </p>
                    </address>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive m-t-20" style="clear: both;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Paket</th>
                                <th class="text-right">Berat</th>
                                <th class="text-right">Payment</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice as $item)
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>{{$item->price->jenis}}</td>
                                    <td class="text-right">{{$item->kg}} / kg</td>
                                    <td class="text-right">{{$item->jenis_pembayaran}}</td>
                                    <td class="text-right">{{Rupiah::getRupiah($item->harga)}} /kg</td>
                                    <td class="text-right">
                                        <input type="hidden" value="{{$hitung = $item->kg * $item->harga}}">
                                        <p>{{Rupiah::getRupiah($hitung)}}</p>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                {{-- <div class="pull-left m-t-10">
                    <h6 class="text-right" style="font-weight:bold">Tanda Tangan Penerima:</h6>
                    <p>
                    <br>
                    <br>
                    <br>
                    ----------------------------------
                    </p>
                </div> --}}
                <div class="pull-left m-t-10">
                    <h6>Metode Pembayaran :</h6>
                    <ol style="font-size: 12px">
                    @foreach ($data_banks as $banks)
                        <li style="color: black"> {{$banks->nama_bank}} <br> {{$banks->no_rekening}} a/n {{$banks->nama_pemilik}}</li>
                    @endforeach
                    </ol>
                </div>
                <div class="pull-right m-t-10 text-right">
                    <p>Total : {{Rupiah::getRupiah($hitung)}}</p>
                    <p>Disc @if ($item->disc == "")
                        (0 %)
                    @else
                        ({{$item->disc}} %)
                    @endif :  </p>
                    <hr>
                    <h3><b>Total Bayar :</b> {{Rupiah::getRupiah($item->harga_akhir)}}</h3>
                </div>
                @endforeach
                <div class="clearfix"></div>
                <hr>
                <div class="text-right">
                    <a href="{{url('pelayanan')}}" class="btn btn-primary" style="color:white">Kembali</a>
                    <a href="{{url('cetak-invoice/'.$item->id. '/print')}}" target="_blank" class="btn btn-outline-primary"><i class="fa fa-print"></i>Print</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
