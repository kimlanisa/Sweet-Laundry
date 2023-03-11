@extends('layouts.frontend')
@section('title','Selamat Datang')
@section('content')

<div class="app-content content ">
    <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="auth-wrapper auth-v1 px-2">
                        <div class="auth-inner py-2">
                            <div class="card mb-0">
                                <div class="card-body">
                                <a href="{{route('login')}}" class="btn btn-sm btn-primary float-right" style="color:white">Login</a>
                                    <a href="javascript:void(0);" class="brand-logo">
                                        <h2 class="brand-text text-primary ml-1">Sweet Laundry</h2>
                                    </a>
                                    <div class="container">
                                    <h6>Lacak Status Laundry Kamu Disini...</h6>
                                    <div class="input-group m-b-20">
                                        <input type="text" class="form-control input-lg" id="search_status" placeholder="Contoh : TR0392928" />
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary" id="search-btn"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                    @include('frontend.modal')
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
  $(document).on('click', '.search-btn', function(e){
      _curr_val = $('#search_status').val();
      $('#search_status').val(_curr_val + $(this).html());
  });

  $(document).on('click', '#search-btn', function (e) {
      var search_status = $("#search_status").val();
      $.get('pencarian-laundry',{'_token': $('meta[name=csrf-token]').attr('content'),search_status:search_status}, function(resp){
            if (resp != 0) {
                  $(".modal_status").show();
                  $("#customer").html(resp.customer);
                  $("#tgl_transaksi").html(resp.tgl_transaksi);
                  $("#status_order").html(resp.status_order);
                  $("#harga_akhir").html(resp.harga_akhir);
            }else{
                swal({html: "No Invoice Tidak Terdaftar!"})
            }
      });
  });
  function close_dlgs(){
        $(".modal_status").hide();
        $("#search_status").val("");
  }
</script>
@endsection





