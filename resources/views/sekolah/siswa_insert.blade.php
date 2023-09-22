
@extends('layouts.sekolah')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/sekolah">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/sekolah/siswa">Data Siswa SPW</a></li>
          <li class="breadcrumb-item active">Tambah Data Siswa SPW</li>
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
                                <h5 class="card-title users">Tambah Data Siswa</h5>
                                <p>Tambah data Siswa SPW yang ada di Sekolah!</p>
                              </div>
                            </div>
                          </div>
                            <!-- <hr class="dropdown-header mb-3"> -->
                            <form class="row g-3" action="/sekolah/siswa/store" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-6">
                                  <div class="col-12 mb-4">  
                                      <label for="inputNISN" class="form-label">NISN<span class="text-danger">*</span></label> 
                                      <input type="number" class="form-control mb-1 @error('nisn')
                                      is-invalid
                                      @enderror" id="inputNISN" name="nisn" value="{{ old('nisn') }}" onKeyPress="if(this.value.length==10) return false;" required>
                                      <small id="alertNISN" class="form-text text-muted"></small>
                                      @error('nisn')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12 mb-4"> 
                                      <label for="inputNamaLengkap" class="form-label">Nama Lengkap<span class="text-danger">*</span></label> 
                                      <input type="text" class="form-control @error('nama_lengkap')
                                          is-invalid
                                      @enderror" id="inputNamaLengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                      @error('nama_lengkap')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12 mb-4"> 
                                      <label for="inputNoHp" class="form-label">No Hp<span class="text-danger">*</span></label> 
                                      <input type="number" placeholder="08**********" class="form-control mb-1 @error('no_hp')
                                          is-invalid
                                      @enderror" onKeyPress="if(this.value.length==12) return false;" id="inputNoHp" name="no_hp" value="{{ old('no_hp') }}" required>
                                      <small id="alertNoHp" class="text-muted"></small>
                                      @error('no_hp')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12 mb-4"> 
                                      <label for="inputKelas" class="form-label">Kelas<span class="text-danger">*</span></label> 
                                      <input type="text" class="form-control @error('kelas')
                                          is-invalid
                                      @enderror" id="inputKelas" name="kelas" value="{{ old('kelas') }}" required>
                                      @error('kelas')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12 mb-4"> 
                                      <label for="inputJurusan" class="form-label">Jurusan<span class="text-danger">*</span></label> 
                                      <input type="text" class="form-control @error('jurusan')
                                          is-invalid
                                      @enderror" id="inputJurusan" name="jurusan" value="{{ old('jurusan') }}" required>
                                      @error('jurusan')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12 mb-4">
                                      <label for="id_kcd" class="form-label">Kantor Cabang Dinas (KCD)<span class="text-danger">*</span></label>
                                      <select id="id_kcd" style="width: 100%;" name="id_kcd">
                                        <option value="{{ $sekolah[0]->kab->kcd->id }}" selected>{{ $sekolah[0]->kab->kcd->nama_kcd }}</option>
                                      </select>
                                      @error('id_kcd')
                                      <div style="font-size: 14px;" class="text-danger">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12 mb-4">
                                      <label for="id_kab" class="form-label">Kabupaten/Kota<span class="text-danger">*</span></label>
                                      <select id="id_kab" style="width: 100%;" name="id_kab">
                                        <option value="{{ $sekolah[0]->kab->id}}" selected>{{ $sekolah[0]->kab->nama_kab }}</option>
                                      </select>
                                      @error('id_kab')
                                      <div style="font-size: 14px;" class="text-danger">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12 mb-4">
                                      <label for="npsn_sekolah" class="form-label">Sekolah<span class="text-danger">*</span></label>
                                      <select id="npsn_sekolah" style="width: 100%;" name="npsn_sekolah">
                                        <option value="{{ $sekolah[0]->npsn}}" selected>{{ $sekolah[0]->nama_sekolah }}</option>
                                      </select>
                                      @error('npsn_sekolah')
                                      <div style="font-size: 14px;" class="text-danger">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12 mb-4"> 
                                    <label for="inputNamaKepsek" class="form-label">Nama Kepala Sekolah<span class="text-danger">*</span></label> 
                                    <input type="text" class="form-control @error('nama_kepsek')
                                        is-invalid
                                    @enderror" id="inputNamaKepsek" name="nama_kepsek" value="{{ old('nama_kepsek') }}" required>
                                    @error('nama_kepsek')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                  <div class="col-12 mb-4"> 
                                      <label for="inpuMerkBrand" class="form-label">Nama Merk/Brand<span class="text-danger">*</span></label>
                                      <input type="text" class="form-control @error('merk_brand')
                                          is-invalid
                                      @enderror" id="inpuMerkBrand" name="merk_brand" value="{{ old('merk_brand') }}" required>
                                      @error('merk_brand')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12 mb-4">
                                      <label class="form-label">Jenis Usaha<span class="text-danger">*</span></label>
                                      <div class="form-group">
                                          <div class="radio">
                                          <label class="radio-inline control-label mb-2">
                                            <input type="radio" class="form-check-input" id="radioKuliner" name="jenis_usaha" value="Kuliner" @if (old("jenis_usaha") == "Kuliner")
                                                checked
                                            @endif/>
                                            Kuliner
                                          </label>
                                      </div>
                                      <div class="form-group">
                                        <label class="radio-inline control-label mb-2">
                                            <input type="radio" class="form-check-input" id="radioFashion" name="jenis_usaha" value="Fashion" @if (old("jenis_usaha") == "Fashion")
                                                checked
                                            @endif/>
                                         Fashion
                                        </label>
                                      </div>
                                      <div class="form-group">
                                        <label class="radio-inline control-label mb-2">
                                            <input type="radio" class="form-check-input" id="radioKosmetik" name="jenis_usaha" value="Kosmetik" @if (old("jenis_usaha") == "Kosmetik")
                                                checked
                                            @endif/>
                                          Kosmetik
                                        </label>
                                      </div>
                                      <div class="form-group other">
                                        <label class="radio-inline control-label mb-2">
                                            <input type="radio" class="form-check-input" id="radioLainnya" name="jenis_usaha" value="Lainnya" 
                                            @php
                                                $usahaLain = False
                                            @endphp
                                            @if (
                                                old("jenis_usaha") != "Kuliner"&&
                                                old("jenis_usaha") != "Fashion"&&
                                                old("jenis_usaha") != "Kosmetik"&&
                                                old("jenis_usaha") != ""
                                            )
                                                checked
                                                @php
                                                $usahaLain = True
                                                @endphp
                                            @endif/>
                                          Lainnya
                                        </label>
                                        <input type="text" class="form-control form-other " id="usahaLainnya" name="usahaLainnya" data-rule-required="true" contenteditable="false"
                                        @if ($usahaLain == True)
                                            value="{{ old("usahaLainnya") }}"
                                        @endif/>
                                      </div>
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
                                    <label class="form-label">Tempat Berjualan<span class="text-danger">*</span></label> 
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Instagram" id="checkInstagram" name="tempat_berjualan[]" {{ in_array('Instagram', old('tempat_berjualan', [])) ? 'checked' : '' }}>
                                      <label class="form-check-label mb-1" for="checkInstagram">
                                         Instagram
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Whatsapp" id="checkWhatsapp" name="tempat_berjualan[]" {{ in_array('Whatsapp', old('tempat_berjualan', [])) ? 'checked' : '' }}>
                                      <label class="form-check-label mb-1" for="checkWhatsapp">
                                        Whatsapp
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Facebook" id="checkFacebook" name="tempat_berjualan[]" {{ in_array('Facebook', old('tempat_berjualan', [])) ? 'checked' : '' }}>
                                      <label class="form-check-label mb-1" for="checkFacebook">
                                        Facebook
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Shopee" id="checkShopee" name="tempat_berjualan[]" {{ in_array('Shopee', old('tempat_berjualan', [])) ? 'checked' : '' }}>
                                      <label class="form-check-label mb-1" for="checkShopee">
                                        Shopee
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Lazada" id="checkLazada" name="tempat_berjualan[]" {{ in_array('Lazada', old('tempat_berjualan', [])) ? 'checked' : '' }}>
                                      <label class="form-check-label mb-1" for="checkLazada">
                                        Lazada
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Tokopedia" id="checkTokopedia" name="tempat_berjualan[]" {{ in_array('Tokopedia', old('tempat_berjualan', [])) ? 'checked' : '' }}>
                                      <label class="form-check-label mb-1" for="checkTokopedia">
                                        Tokopedia
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Bukalapak" id="checkBukapalak" name="tempat_berjualan[]" {{ in_array('Bukalapak', old('tempat_berjualan', [])) ? 'checked' : '' }}>
                                      <label class="form-check-label mb-1" for="checkBukapalak">
                                        Bukalapak
                                      </label>
                                    </div>
                                    <div class="form-check other">
                                        <label class="radio-inline control-label mb-1">
                                          <input type="checkbox" class="form-check-input" id="checkLainnya" name="tempat_berjualan[]" value="Lainnya" {{ in_array('Lainnya', old('tempat_berjualan', [])) ? 'checked' : '' }} />
                                          Lainnya
                                        </label>
                                        <input type="text" class="form-control form-other m-0" id="tempatLainnya" name="tempatLainnya" data-rule-required="true" contenteditable="false"/>
                                    </div>
                                    @error('tempat_berjualan')
                                    <div style="font-size: 14px;" class="text-danger">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                  <div class="col-12 mb-4"> 
                                    <label for="inputNib" class="form-label">NIB</label> 
                                    <input type="number" maxlength="6" class="form-control @error('nib')
                                        is-invalid
                                    @enderror" id="inputNib" name="nib" value="{{ old('nib') }}">
                                    @error('nib')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                  <div class="col-12 mb-4"> 
                                    <label for="inputOmset" class="form-label">Omset<span class="text-danger">*</span></label> 
                                    <input type="text" class="form-control @error('omset')
                                        is-invalid
                                    @enderror" id="inputOmset"  value="{{ old('omset') }}" required>
                                    @error('omset')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror 
                                    <input type="text" class="form-control" hidden id="rupiah" name="omset" value="{{ old('omset') }}">
                                  </div>
                                  <div class="col-12 mb-4">
                                      <label for="inputYear" class="form-label">Tahun Rekap<span class="text-danger">*</span></label>
                                      <input type="number" class="form-control @error('tahun_rekap')
                                          is-invalid
                                      @enderror" id="inputYear" name="tahun_rekap" value="{{ old('tahun_rekap') }}" required>
                                      @error('tahun_rekap')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12 mb-4">
                                    <label for="formFileLaporan" class="form-label">Upload Laporan Keuangan(pdf)<span class="text-danger">*</span></label>
                                    <input class="form-control @error('laporan_keuangan')
                                        is-invalid
                                    @enderror" type="file" id="formFileLaporan" onchange="checkFile()" name="laporan_keuangan" accept=".pdf">
                                    @if(!$errors->any())
                                      <p class="invalid-feedback" id="uploadMessage" style="display: block;">Upload file</p>
                                    @endif
                                    @error('laporan_keuangan')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                  <div class="col-12 mb-4">
                                    <label for="formFileFoto" class="form-label">Upload Foto Produk(jpg, jpeg, png)<span class="text-danger">*</span></label>
                                    <input class="form-control @error('foto_produk')
                                        is-invalid
                                    @enderror" type="file" id="formFileFoto" onchange="checkFoto()" name="foto_produk" accept="image/*">
                                    @if(!$errors->any())
                                      <p class="invalid-feedback" id="fotoMessage" style="display: block;">Upload Foto</p>
                                    @endif
                                    @error('foto_produk')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                  <div class="col-12 mb-4">
                                    <label for="inputDeskripsi">Deskripsi Produk<span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('deskripsi_produk')
                                        is-invalid
                                    @enderror" id="inputDeskripsi" rows="3" name="deskripsi_produk" required>{{ old('deskripsi_produk') }}</textarea>
                                    @error('deskripsi_produk')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                </div>
                                  <div class="modal-footer">
                                      <a href="/sekolah/siswa" class="btn btn-dark me-3"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
                                      
                                      <button type="sumbit" class="btn btn-outline-dark me-1"><i class="bi bi-person-check-fill"></i> Tambah Data</button>
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
  <script>
    $(document).ready(function () {
      @if(count($errors) > 0)
        Swal.fire("Error", "Kelola data gagal!", "error");
      @endif
      
      $('#usahaLainnya').hide();                  
      $("input[type='radio']").on('click', function(){
        if ($("#radioLainnya").is(':checked')){
          $('#usahaLainnya').fadeIn();
          $('#usahaLainnya').prop("required", true);
        }else{
          $('#usahaLainnya').hide();
          $('#usahaLainnya').prop("required", false);
        }
      })
      if ($("#radioLainnya").is(':checked')){
          $('#usahaLainnya').fadeIn();
          $('#usahaLainnya').prop("required", true);
      }

      $('#tempatLainnya').hide();
      $("#checkLainnya").on('click', function(){
        if ($(this).is(':checked')){
          $('#tempatLainnya').fadeIn();
          $('#tempatLainnya').prop("required", true);
        }else{
          $('#tempatLainnya').hide();
          $('#tempatLainnya').prop("required", false);
        }
      })
    });
</script>
@endsection