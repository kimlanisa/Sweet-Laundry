@extends('layouts.backend')
@section('title','Profile')
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
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <div class="col text-center">
                    <div class="m-t-30">
                      {{-- <img class="round" src="{{asset(Auth::user()->foto == null ? 'backend/images/profile/user.jpg' : 'storage/images/foto_profile/'. Auth::user()->foto )}}" height="150" width="150"> --}}
                        <h4 class="card-title mt-1">{{Auth::user()->name}}</h4>
                        <h6 class="card-subtitle">{{Auth::user()->roles->first()->name}}</h6>
                    </div>
                </div>
            </div>
            <div>
                <hr> </div>
            <div class="card-body">
                <small class="text-muted">Email Laundry </small>
                    <h6>{{Auth::user()->email}}</h6>
                <small class="text-muted p-t-30 db">No Telp Laundry</small>
                    <h6>{{Auth::user()->no_telp}}</h6>
                <small class="text-muted p-t-30 db">Alamat Laundry</small>
                    <h6>{{Auth::user()->alamat}}</h6>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
              <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Informasi</a> </li>
            </ul>
            <div class="card-body">
              <form action=" {{url('profile-admin/update', Auth::id())}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group has-success">
                        <label class="control-label">Nama Laundry</label>
                        <input type="text" name="name" value=" {{Auth::user()->name}} " class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                          <span class="invalid-feedback text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group has-success">
                        <label class="control-label">Email Laundry</label>
                        <input type="text" name="email" value=" {{Auth::user()->email}} " class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                          <span class="invalid-feedback text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group has-success">
                        <label class="control-label">Alamat Laundry</label>
                        <textarea name="alamat" class="form-control" id="alamat" cols="5"> {{Auth::user()->alamat}} </textarea>
                        @error('alamat')
                          <span class="invalid-feedback text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group has-success">
                        <label class="control-label">No Telp Laundry</label>
                        <input type="text" name="number" class="form-control" value="{{Auth::user()->no_telp}}" />
                        @error('no_telp')
                          <span class="invalid-feedback text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group has-success">
                        <label class="control-label">Foto Laundry</label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                        <span class="small text-warning">Biarkan kosong jika tidak ingin di update.</span>
                        @error('foto')
                          <span class="invalid-feedback text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group has-success">
                        <label class="control-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        <span class="small text-warning">Biarkan kosong jika tidak ingin di update.</span>
                        @error('password')
                          <span class="invalid-feedback text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group has-success">
                        <label class="control-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                        <span class="small text-warning">Biarkan kosong jika tidak ingin di update.</span>
                        @error('password_confirmation')
                          <span class="invalid-feedback text-danger" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary float-right"> <i class="fa fa-check"></i> Update</button>
                    <a href="/home" class="btn btn-inverse float-right">Batal</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




