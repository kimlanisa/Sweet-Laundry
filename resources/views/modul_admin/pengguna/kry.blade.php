@extends('layouts.backend')
@section('title','Admin - Data Karyawan')
@section('header','Data Karyawan')
@section('content')
@if ($message = Session::get('success'))
  <div class="alert alert-success alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
  </div>
@elseif($message = Session::get('error'))
  <div class="alert alert-danger alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
  </div>
@endif
<div class="row">
  <div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"> Data Karyawan
                <a href="{{route('karyawan.create')}}" class="btn btn-primary">Tambah</a>
            </h4>

            <div class="table-responsive">
                <table class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Karyawan</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach ($kry as $item)
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->no_telp}}</td>
                            <td>
                                <a class="btn btn-sm btn-{{$item->status == 'Active' ? 'primary' : 'danger'}}" data-id-update="{{$item->id}}" id="updateStatus">{{$item->status == 'Active' ? 'Non-Aktifkan' : 'Aktifkan'}}</a>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <i class="feather icon-more-vertical font-medium-3 cursor-pointer dropdown-menu-right" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </i>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{route('karyawan.edit', $item->id)}}">Edit</a>
                                        <a class="dropdown-item" href="{{route('karyawan-delete', $item->id)}}">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  // Update Status Karyawan
  $(document).on('click', '#updateStatus', function () {
    var id = $(this).attr('data-id-update');
    $.get('update-status-karyawan', {'_token' : $('meta[name=csrf-token]').attr('content'),id:id}, function(_resp){
      location.reload()
    });
  });

</script>

@endsection
