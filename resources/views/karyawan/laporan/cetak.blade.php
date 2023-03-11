<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:18px;
            margin:0;
        }
        .container{
            margin:0 auto;
            margin-top:35px;
            padding:0px;
            width:100%;
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:28px;
            margin-bottom:15px;
        }
        table{
            border:0px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width:100%;
        }
        td, tr, th{
            padding:12px;
            border:1px solid #333;
            width:auto;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <table>
            <thead>
                <tr>
                    <th colspan="5">Invoice <strong>{{$data->invoice}}</strong></th>
                    <th>{{ $data->created_at->format('d-M-Y') }}</th>
                </tr>
                <tr>
                    <td colspan="6">
                        <h3 style="text-align:right">Detail Order Konsumen :</h3>
                        <p style="text-align:right">
                            {{$data->customers->name ?? ''}}
                            <br/> {{$data->customers->alamat ?? ''}}
                            <br/> {{$data->customers->no_telp ?? ''}}</p> <br>
                        <p style="text-align:right"><b>Tanggal Masuk :</b> <i class="fa fa-calendar"></i> {{carbon\carbon::parse($data->tgl_transaksi)->format('d-m-y')}}</p>
                        <p style="text-align:right"><b>Tanggal Diambil :</b> <i class="fa fa-calendar"></i>
                            {{-- @if ($data->tgl_ambil == "")
                                {{-- Belum Diambil --}}
                            {{-- @else  --}}
                            {{carbon\carbon::parse($data->tgl_ambil)->format('d-m-y')}}
                            {{-- @endif --}}
                        </p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="text-center">#</th>
                    <th>Paket Laundry</th>
                    <th class="text-right">Berat</th>
                    <th class="text-right">Payment</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Total</th>
                </tr>
                @foreach ($invoice as $item)
                <tr>
                    <td style="color:black">1</td>
                    <td style="color:black">{{$item->price->jenis}}</td>
                    <td style="color:black">{{$item->kg}} Kg</td>
                    <td style="color:black">{{$item->jenis_pembayaran}}</td>
                    <td style="color:black">{{Rupiah::getRupiah($item->harga)}} /Kg</td>
                    <td><input type="hidden" value="{{$hitung = $item->kg * $item->harga}}">
                        <p style="color:black">{{Rupiah::getRupiah($hitung)}}</p></td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="5">Disc @if ($item->disc == "")
                        0 %
                    @else
                        {{$item->disc}} %
                    @endif </th>
                    <td style="color:black"><input type="hidden" value="{{$disc = ($hitung * $item->disc) / 100}}"> {{Rupiah::getRupiah($disc)}}</td>
                </tr>
                <tr>
                    <th colspan="5">Total Bayar</th>
                    <td style="color:black; font-weight:bold">{{Rupiah::getRupiah($item->harga_akhir)}}</td>
                </tr>
            </tbody>
        </table>
        <h6>Metode Pembayaran :</h6>
        <ol style="font-size: 12px">
          @foreach ($data_banks as $banks)
            <li style="color: black"> {{$banks->nama_bank}} <br> {{$banks->no_rekening}} a/n {{$banks->nama_pemilik}}</li>
          @endforeach
        </ol>
    </div>
</body>
</html>
