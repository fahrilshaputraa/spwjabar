
@extends('layouts.sekolah')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/sekolah">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/sekolah/siswa">Data Siswa SPW</a></li>
          <li class="breadcrumb-item active">Edit Data Siswa SPW</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
      <div class="row">
          <div class="col-lg-12">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="header-tabel">
                            <div class="row title-table align-items-center">
                              <div class="col">
                                <h5 class="card-title users">Edit Data Siswa</h5>
                                <p>Edit data Siswa SPW yang ada di Sekolah!</p>
                              </div>
                            </div>
                          </div>
                            <!-- <hr class="dropdown-header mb-3"> -->
                          <form class="row g-3" action="/sekolah/siswa/update" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-6">
                              <div class="col-12 mb-4"> 
                                  <label for="inputEditNISN" class="form-label"><span class="text-danger">*</span>NISN</label> 
                                  <input type="number" class="form-control @error('nisn')
                                      is-invalid
                                  @enderror" id="inputEditNISN" name="nisn" required readonly value="{{ $siswa->nisn }}">
                                  @error('nisn')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12 mb-4"> 
                                  <label for="inputEditNamaLengkap" class="form-label"><span class="text-danger">*</span>Nama Lengkap</label> 
                                  <input type="text" class="form-control @error('nama_lengkap')
                                      is-invalid
                                  @enderror" id="inputEditNamaLengkap" name="nama_lengkap" required value="{{ old('nama_lengkap')?? $siswa->nama_lengkap }}">
                                  @error('nama_lengkap')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12 mb-4"> 
                                  <label for="inputEditNoHp" class="form-label"><span class="text-danger">*</span>No Hp</label> 
                                  <input type="number" placeholder="08**********" class="form-control mb-1 @error('no_hp')
                                      is-invalid
                                  @enderror" onKeyPress="if(this.value.length==12) return false;" id="inputEditNoHp" name="no_hp" required value="{{ old('no_hp')??$siswa->no_hp }}">
                                  <small class="form-text text-muted" id="alertEditNoHp"></small>
                                  @error('no_hp')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12 mb-4"> 
                                  <label for="inputEditKelas" class="form-label"><span class="text-danger">*</span>Kelas</label> 
                                  <input type="text" class="form-control @error('kelas')
                                      is-invalid
                                  @enderror" id="inputEditKelas" name="kelas" required value="{{old('kelas')?? $siswa->kelas }}">
                                  @error('kelas')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12 mb-4"> 
                                  <label for="inputEditJurusan" class="form-label"><span class="text-danger">*</span>Jurusan</label> 
                                  <input type="text" class="form-control @error('jurusan')
                                      is-invalid
                                  @enderror" id="inputEditJurusan" name="jurusan" required value="{{old('jurusan')?? $siswa->jurusan }}">
                                  @error('jurusan')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12 mb-4">
                                  <label for="id_kcd_edit" class="form-label"><span class="text-danger">*</span>Kantor Cabang Dinas (KCD)</label>
                                  <select id="id_kcd_edit" style="width: 100%;" name="id_kcd">
                                    <option value="{{ $sekolah[0]->kab->kcd->id }}" selected>{{ $sekolah[0]->kab->kcd->nama_kcd }}</option>
                                  </select>
                                  @error('id_kcd')
                                  <div style="font-size: 14px;" class="text-danger">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12 mb-4">
                                  <label for="id_kab_edit" class="form-label"><span class="text-danger">*</span>Kabupaten/Kota</label>
                                  <select id="id_kab_edit" style="width: 100%;" name="id_kab">
                                    <option value="{{ $sekolah[0]->kab->id}}" selected>{{ $sekolah[0]->kab->nama_kab }}</option>
                                  </select>
                                  @error('id_kab')
                                  <div style="font-size: 14px;" class="text-danger">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12 mb-4">
                                  <label for="npsn_sekolah_edit" class="form-label"><span class="text-danger">*</span>Sekolah</label>
                                  <select id="npsn_sekolah_edit" style="width: 100%;" name="npsn_sekolah">
                                    <option value="{{ $sekolah[0]->npsn}}" selected>{{ $sekolah[0]->nama_sekolah }}</option>
                                  </select>
                                  @error('npsn_sekolah')
                                  <div style="font-size: 14px;" class="text-danger">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12 mb-4"> 
                                <label for="inputEditNamaKepsek" class="form-label"><span class="text-danger">*</span>Nama Kepala Sekolah</label> 
                                <input type="text" class="form-control @error('nama_kepsek')
                                    is-invalid
                                @enderror" id="inputEditNamaKepsek" name="nama_kepsek" required value="{{old('nama_kepsek')?? $siswa->nama_kepsek }}">
                                @error('nama_kepsek')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                              <div class="col-12 mb-4"> 
                                  <label for="inputEditMerkBrand" class="form-label"><span class="text-danger">*</span>Nama Merk/Brand</label>
                                  <input type="text" class="form-control @error('merk_brand')
                                      is-invalid
                                  @enderror" id="inputEditMerkBrand" name="merk_brand" value="{{ old('merk_brand')?? $siswa->merk_brand}}" required>
                                  @error('merk_brand')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12 mb-4">
                                  <label class="form-label"><span class="text-danger">*</span>Jenis Usaha</label>
                                  <div class="form-group">
                                      <div class="radio">
                                      <label class="radio-inline control-label mb-2">
                                        <input type="radio" class="form-check-input" id="editRadioKuliner" name="jenis_usaha" value="Kuliner" @if ($siswa->jenis_usaha == "Kuliner")
                                            checked
                                        @endif/>
                                        Kuliner
                                      </label>
                                  </div>
                                  <div class="form-group">
                                    <label class="radio-inline control-label mb-2">
                                      <input type="radio" class="form-check-input" id="editRadioFashion" name="jenis_usaha" value="Fashion" 
                                      @if ($siswa->jenis_usaha == "Fashion")
                                        checked
                                      @endif/>
                                      Fashion
                                    </label>
                                  </div>
                                  <div class="form-group">
                                    <label class="radio-inline control-label mb-2">
                                      <input type="radio" class="form-check-input" id="editRadioKosmetik" name="jenis_usaha" value="Kosmetik" 
                                      @if ($siswa->jenis_usaha == "Kosmetik")
                                        checked
                                      @endif/>
                                      Kosmetik
                                    </label>
                                  </div>
                                  <div class="form-group other">
                                    <label class="radio-inline control-labe mb-2">
                                      <input type="radio" class="form-check-input" id="editRadioLainnya" name="jenis_usaha" value="Lainnya" 
                                      @php
                                        $usahaLain = False
                                      @endphp
                                      @if (
                                          $siswa->jenis_usaha != "Kuliner"&&
                                          $siswa->jenis_usaha != "Fashion"&&
                                          $siswa->jenis_usaha != "Kosmetik"
                                          )
                                        checked
                                        @php
                                          $usahaLain = True
                                        @endphp
                                      @endif/>
                                      Lainnya
                                    </label>
                                    <input type="text" class="form-control form-other" id="editUsahaLainnya" name="usahaLainnya" data-rule-required="true" contenteditable="false"
                                    @if ($usahaLain == True)
                                        value="{{ $siswa->jenis_usaha }}"
                                    @endif/>
                                  </div>
                                <small class="form-text text-muted">*pilihan akan di ganti bila diisi | Kosongkan jika tidak ingin diganti</small>
                                  @error('jenis_usaha')
                                  <div style="font-size: 14px;" class="text-danger">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="col-12 mb-4">
                                <label class="form-label"><span class="text-danger">*</span>Tempat Berjualan</label> 
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Instagram" id="editCheckInstagram" name="tempat_berjualan[]" 
                                  @if (in_array("Instagram", $jualan))
                                      checked
                                  @endif
                                  >
                                  <label class="form-check-label mb-1" for="editCheckInstagram">
                                    Instagram
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Whatsapp" id="editCheckWhatsapp" name="tempat_berjualan[]"
                                  @if (in_array("Whatsapp", $jualan))
                                      checked
                                  @endif
                                  >
                                  <label class="form-check-label mb-1" for="editCheckWhatsapp">
                                    Whatsapp
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Facebook" id="editCheckFacebook" name="tempat_berjualan[]"
                                  @if (in_array("Facebook", $jualan))
                                      checked
                                  @endif
                                  >
                                  <label class="form-check-label mb-1" for="editCheckFacebook">
                                    Facebook
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Shopee" id="editCheckShopee" name="tempat_berjualan[]"
                                  @if (in_array("Shopee", $jualan))
                                      checked
                                  @endif
                                  >
                                  <label class="form-check-label mb-1" for="editCheckShopee">
                                    Shopee
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Lazada" id="editCheckLazada" name="tempat_berjualan[]"
                                  @if (in_array("Lazada", $jualan))
                                      checked
                                  @endif
                                  >
                                  <label class="form-check-label mb-1" for="editCheckLazada">
                                    Lazada
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Tokopedia" id="editCheckTokopedia" name="tempat_berjualan[]"
                                  @if (in_array("Tokopedia", $jualan))
                                      checked
                                  @endif
                                  >
                                  <label class="form-check-label mb-1" for="editCheckTokopedia">
                                    Tokopedia
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Bukalapak" id="editCheckBukapalak" name="tempat_berjualan[]"
                                  @if (in_array("Bukalapak", $jualan))
                                      checked
                                  @endif
                                  >
                                  <label class="form-check-label mb-1" for="editCheckBukapalak">
                                    Bukalapak
                                  </label>
                                </div>
                                <div class="form-check other">
                                    <label class="radio-inline control-label mb-1">
                                      <input type="checkbox" class="form-check-input" id="editCheckLainnya" name="tempat_berjualan[]" value="Lainnya"
                                      {{-- @php
                                        $confirm = False
                                      @endphp
                                      @foreach ($jualan as $j)
                                          @if (
                                          $j != "Instagram"&&
                                          $j != "Whatsapp"&&
                                          $j != "Facebook"&&
                                          $j != "Shopee"&&
                                          $j != "Lazada"&&
                                          $j != "Tokopedia"&&
                                          $j != "Bukalapak"&&
                                          $j != "")
                                              checked
                                              @php
                                                $confirm = True
                                              @endphp
                                          @endif
                                      @endforeach
                                      />
                                      Lainnya
                                    </label>
                                    <input type="text" class="form-control form-other" id="editTempatLainnya" name="tempatLainnya" data-rule-required="true" contenteditable="false" value="@if($confirm == True){{ $jualan[count($jualan)-2] }}@endif"/> --}}
                                    @php
                                    $confirm = False;
                                    $lainnyaValue = "";
                                    @endphp

                                    @foreach ($jualan as $j)
                                        @if (
                                        $j != "Instagram"&&
                                        $j != "Whatsapp"&&
                                        $j != "Facebook"&&
                                        $j != "Shopee"&&
                                        $j != "Lazada"&&
                                        $j != "Tokopedia"&&
                                        $j != "Bukalapak"&&
                                        $j != "")
                                            checked
                                            @php
                                                $confirm = True;
                                                $lainnyaValue = $j;
                                            @endphp
                                        @endif
                                    @endforeach
                                    />
                                    Lainnya
                                  </label>
                                    <input type="text" class="form-control form-other" id="editTempatLainnya" name="tempatLainnya" data-rule-required="true" contenteditable="false" value="{{ $lainnyaValue }}"/>
                                </div>
                                <small class="form-text text-muted">*pilihan akan di ganti bila diisi | Kosongkan jika tidak ingin diganti</small>
                                @error('tempat_berjualan')
                                <div style="font-size: 14px;" class="text-danger">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                              <div class="col-12 mb-4"> 
                                <label for="inputEditNib" class="form-label"><span class="text-danger">*</span>NIB</label> 
                                <input type="number" maxlength="6" class="form-control @error('nib')
                                    is-invalid
                                @enderror" id="inputEditNib" name="nib" value="{{ old('nib')?? $siswa->nib }}">
                                @error('nib')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                              <div class="col-12 mb-4"> 
                                <label for="inputEditOmset" class="form-label">Omset</label> 
                                <input type="text" class="form-control @error('omset')
                                    is-invalid
                                @enderror" id="inputEditOmset" name="omset" required value="{{ old('omset')?? $siswa->omset }}">
                                @error('omset')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                                <input type="text" class="form-control" hidden id="rupiahEdit" name="omset" value="{{ old('omset')?? $siswa->omset }}">
                              </div>
                              <div class="col-12 mb-4">
                                  <label for="inputEditYear" class="form-label"><span class="text-danger">*</span>Tahun Rekap</label>
                                  <input type="number" class="form-control @error('tahun_rekap')
                                      is-invalid
                                  @enderror" id="inputEditYear" name="tahun_rekap" value="{{ old('tahun_rekap')?? $siswa->tahun_rekap }}" required>
                                  @error('tahun_rekap')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12 mb-4">
                                <label for="formEditFileLaporan" class="form-label"><span class="text-danger">*</span>Upload Laporan Keuangan(pdf)</label>
                                <input class="form-control @error('laporan_keuangan')
                                    is-invalid
                                @enderror" type="file" id="formEditFileLaporan" name="laporan_keuangan"/>
                                <small class="form-text text-muted">*pilihan akan di ganti bila diisi | Kosongkan jika tidak ingin diganti</small>
                                @error('laporan_keuangan')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                                
                                <P class="m-0">
                                  Laporan keuangan sebelumnya: 
                                  <a href="/Laporan Keuangan/{{ $siswa->laporan_keuangan }}" target="_blank">Lihat</a>
                                </P>
                              </div>
                              <div class="col-12 mb-4">
                                <label for="formEditFileFoto" class="form-label"><span class="text-danger">*</span>Upload Foto Produk(jpg, jpeg, png)</label>
                                <input class="form-control @error('foto_produk')
                                    is-invalid
                                @enderror" type="file" id="formEditFileFoto" name="foto_produk"/>
                                <small class="form-text text-muted">*pilihan akan di ganti bila diisi | Kosongkan jika tidak ingin diganti</small>
                                @error('foto_produk')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                                <p>Foto sebelumnya: <a data-bs-toggle="modal" data-bs-target="#lihatFoto" class="text-warning">Lihat</a></p>
                              </div>
                              <div class="col-12 mb-4">
                                <label for="inputEditDeskripsi"><span class="text-danger">*</span>Deskripsi Produk</label>
                                <textarea class="form-control @error('deskripsi_produk')
                                    is-invalid
                                @enderror" id="inputEditDeskripsi" rows="5" name="deskripsi_produk" required>{{ old('deskripsi_produk')?? $siswa->deskripsi_produk }}</textarea>
                                @error('deskripsi_produk')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                                <input type="text" name="old_laporan" id="oldLaporan" value="{{ $siswa->laporan_keuangan }}" hidden>
                                <input type="text" name="old_foto" id="oldFoto" value="{{ $siswa->foto_produk }}" hidden>
                              </div>
                            </div>
                              <div class="modal-footer">
                                  <a href="/sekolah/siswa" class="btn btn-dark me-3"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
                                  
                                  <button type="sumbit" class="btn btn-outline-dark me-1"><i class="bi bi-person-check-fill"></i> Edit Data</button>
                              </div>
                          </form>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
  </main>
  <div class="modal fade" id="lihatFoto" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-secondary-light">
                <h3 class="modal-title">Foto Produk</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img class="img-fluid rounded" src="/Foto Produk/{{ $siswa->foto_produk }}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-1"></i>Kembali</button> 
            </div>
         </div>
    </div>
  </div>
  <script>
    $(document).ready(function () {
      @if(count($errors) > 0)
        Swal.fire("Error", "Kelola data gagal!", "error");
      @endif

      $('#editUsahaLainnya').hide();                  
      $("input[type='radio']").on('click', function(){
        if ($("#editRadioLainnya").is(':checked')){
          $('#editUsahaLainnya').fadeIn();
          $('#editUsahaLainnya').prop("required", true);
        }else{
          $('#editUsahaLainnya').hide();
          $('#editUsahaLainnya').prop("required", false);
        }
      })
      if ($("#editRadioLainnya").is(':checked')){
        $('#editUsahaLainnya').fadeIn();
        $('#editUsahaLainnya').prop("required", true);
      }

      $('#editTempatLainnya').hide();
      $("#editCheckLainnya").on('click', function(){
        if ($(this).is(':checked')){
          $('#editTempatLainnya').fadeIn();
          $('#editTempatLainnya').prop("required", true);
        }else{
          $('#editTempatLainnya').hide();
          $('#editTempatLainnya').prop("required", false);
        }
      })
      if ($("#editCheckLainnya").is(':checked')){
        $('#editTempatLainnya').fadeIn();
        $('#editTempatLainnya').prop("required", true);
      }
    });
</script>
@endsection