@extends('layouts.backend')
@section('title','Edit Karyawan')
@section('header','Edit Data Karyawan')
@section('content')
<div class="col-lg-12">
    <div class="card card-outline-info">
        <div class="card-header">
            <h4 class="card-title">Form Edit Data Karyawan</h4>
        </div>
        <div class="card-body">
            <form action="{{url('karyawan-update/'.$karyawan->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-body">
                    <div class="row p-t-20">
                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="control-label">Nama</label>
                                <input type="text" class="form-control form-control-danger @error('name') is-invalid @enderror" name="name" value="{{old('name',$karyawan->name)}}" placeholder="Nama Konsumen" autocomplete="off">
                                @error('name')
                                  <span class="invalid-feedback text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="control-label">Email</label>
                                <input type="email" class="form-control form-control-danger @error('email') is-invalid @enderror" name="email" value="{{old('email',$karyawan->email)}}" placeholder="Alamat Email" autocomplete="off">
                                @error('email')
                                  <span class="invalid-feedback text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="control-label">No. WhatsApp</label>
                                <input type="number" class="form-control form-control-danger @error('no_telp') is-invalid @enderror" name="no_telp" placeholder="Nomor WhatsApp" value="{{old('no_telp',$karyawan->no_telp)}}" autocomplete="off">
                                @error('no_telp')
                                  <span class="invalid-feedback text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-12">
                            <div class="form-group has-success">
                                <label class="control-label">Alamat</label>
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" placeholder="Alamat Konsumen"> {{old('alamat', $karyawan->alamat)}} </textarea>
                                @error('alamat')
                                  <span class="invalid-feedback text-danger" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                </div>
                <input type="hidden" name="auth" value="Admin">
                {{-- <div class="form-actions"> --}}
                    <button type="submit" class="btn btn-primary mr-1 mb-1 float-right">Update</button>
                    <a href=" {{url('karyawan')}}"  class="btn btn-interative mr-1 mb-1 float-right">Batal</a>
                {{-- </div> --}}
            </form>
        </div>
    </div>
</div>
@endsection
