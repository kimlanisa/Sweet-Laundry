<div class="modal fade text-left" id="addpayment" tabindex="-1" role="dialog" aria-labelledby="addpayment" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="addpayment">Tambah Data Payment </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{route('setting.bank')}}" method="POST">
            @csrf
            <div class="modal-body">
                <label for="Nama Bank">Nama Bank/E-Wallet</label>
                <div class="form-group">
                  <input type="text" name="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror" placeholder="Nama Bank">
                  @error('nama_bank')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <label>Nomor Rekening/Telp: </label>
                <div class="form-group">
                    <input type="number" name="no_rekening" placeholder="Nomor Rekening" class="form-control @error('no_rekening') is-invalid @enderror">
                    @error('no_rekening')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <label>Nama Pemilik: </label>
                <div class="form-group">
                    <input type="text" name="nama_pemilik" placeholder="Nama Pemilik" class="form-control @error('nama_pemilik') is-invalid @enderror">
                    @error('nama_pemilik')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-intev" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
      </div>
  </div>
</div>
