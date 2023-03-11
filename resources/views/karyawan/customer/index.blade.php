@extends('layouts.backend')
@section('title','Karyawan - Data Customer')
@section('header','Data Customer')
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
<div class="card">
    <div class="card-body">
        <div class="table-responsive m-t-5">
                <a href="{{url('customers-create')}}" class="btn btn-primary">Tambah</a>
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr align="center" style="color:black; font-weight:bold">
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>No Telpon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach ($customer as $item)
                    <tr align="center" style="color:black;">
                        <td>{{$no}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->alamat}}</td>
                        <td>{{$item->no_telp}}</td>
                        <td>
                            <div class="dropdown">
                                <i class="feather icon-more-vertical font-medium-3 cursor-pointer dropdown-menu-right" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </i>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{url('customers', $item->id)}}">Detail</a>
                                    <a class="dropdown-item" href="{{url('customers-edit', $item->id)}}">Edit</a>
                                    <a class="dropdown-item" href="{{url('customers-delete', $item->id)}}">Delete</a>
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
@endsection
@section('scripts')
<script type="text/javascript">
// DataTable
$(document).ready(function() {
    $('#myTable').DataTable();
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
            }],
            "order": [
                [2, 'asc']
            ],
            "displayLength": 25,
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
    });
});
</script>
@endsection
