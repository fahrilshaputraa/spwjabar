@extends('layouts.sekolah')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/sekolah">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/sekolah/alumni">Pendataan Alumni</a></li>
            <li class="breadcrumb-item active">Tambah Data Almuni</li>
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
                                <h5 class="card-title users">Tambah Data Alumni</h5>
                                <p>Semua Data Siswa SPW Alumni yang ada di Sekolah</p>
                              </div>
                            </div>
                          </div>
                            <!-- <hr class="dropdown-header mb-3"> -->
                            <form class="row g-3 mt-1" action="/sekolah/alumni/store" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-6">
                                    <div class="col-12 mb-4"> 
                                      <label class="form-label">Kab/Kota</label>
                                      <select id="mySelect1" style="width: 100%;" name="npsn_sekolah">
                                        <option value="{{ $sekolah[0]->npsn }}" selected>{{ $sekolah[0]->nama_sekolah }}</option>
                                      </select>
                                      @error('npsn_sekolah')
                                      <div style="font-size: 14px;" class="text-danger">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4"> 
                                      <label class="form-label" for="inputKepsek">Nama Kepala Sekolah</label>
                                      <input type="text" id="inputKepsek" class="form-control @error('nama_kepsek')
                                          is-invalid
                                      @enderror" name="nama_kepsek" value="{{ old('nama_kepsek') }}" required>
                                      @error('nama_kepsek')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEmail" class="form-label">Email Sekolah</label>
                                      <input type="email" id="inputEmail" class="form-control @error('email')
                                          is-invalid
                                      @enderror" name="email" value="{{ old('email') }}" required>
                                      @error('email')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputNoHpSekolah" class="form-label">No Hp Sekolah</label>
                                      <input type="number" id="inputNoHpSekolah" class="form-control @error('no_hp_sekolah')
                                          is-invalid
                                      @enderror" name="no_hp_sekolah" value="{{ old('no_hp_sekolah') }}" required>
                                      @error('no_hp_sekolah')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputNamaGuru" class="form-label">Nama Guru</label>
                                      <input type="text" id="inputNamaGuru" class="form-control @error('nama_guru')
                                          is-invalid
                                      @enderror" name="nama_guru" value="{{ old('nama_guru') }}" required>
                                      @error('nama_guru')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputNip" class="form-label">NIP/NUPTK/NUPPPK</label>
                                      <input type="number" id="inputNip" class="form-control @error('nip')
                                          is-invalid
                                      @enderror" name="nip" value="{{ old('nip') }}" required>
                                      @error('nip')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputNoHp" class="form-label">No Hp</label>
                                      <input type="number" id="inputNoHp" class="form-control @error('no_hp')
                                          is-invalid
                                      @enderror" name="no_hp" value="{{ old('no_hp') }}" required>
                                      @error('no_hp')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputJmlSiswa" class="form-label">Jumlah Siswa SPW</label>
                                      <input type="number" id="inputJmlSiswa" class="form-control @error('jml_siswa_dibina')
                                          is-invalid
                                      @enderror" name="jml_siswa_dibina" value="{{ old('jml_siswa_dibina') }}" required>
                                      @error('jml_siswa_dibina')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputJmlKonsisten" class="form-label">Jumlah Siswa Konsiten</label>
                                      <input type="number" id="inputJmlKonsisten" class="form-control @error('jml_siswa_konsisten')
                                          is-invalid
                                      @enderror" name="jml_siswa_konsisten" value="{{ old('jml_siswa_konsisten') }}" required>
                                      @error('jml_siswa_konsisten')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-12 mb-4">
                                      <label for="inputSiswaNIB" class="form-label">Jumlah Siswa Memiliki NIB</label>
                                      <input type="number" id="inputSiswaNIB" class="form-control @error('jml_siswa_nib')
                                          is-invalid
                                      @enderror" name="jml_siswa_nib" value="{{ old('jml_siswa_nib') }}" required>
                                      @error('jml_siswa_nib')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputSiswaUsaha" class="form-label">Jumlah Siswa Melanjutkan Usaha/Menjadi Pengusaha</label>
                                      <input type="number" id="inputSiswaUsaha" class="form-control @error('jmls_almni_pengusaha')
                                          is-invalid
                                      @enderror" name="jmls_almni_pengusaha" value="{{ old('jmls_almni_pengusaha') }}" required>
                                      @error('jmls_almni_pengusaha')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputSiswaPirt" class="form-label">Jumlah Alumni Sudah Punya PIRT</label>
                                      <input type="number" id="inputSiswaPirt" class="form-control @error('jmls_almni_pirt')
                                          is-invalid
                                      @enderror" name="jmls_almni_pirt" value="{{ old('jmls_almni_pirt') }}" required>
                                      @error('jmls_almni_pirt')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputTigaJutaPlus" class="form-label">Jumlah Siswa Mendapat Omset >3jt/Bulan</label>
                                      <input type="number" id="inputTigaJutaPlus" class="form-control @error('jmls_omset1')
                                          is-invalid
                                      @enderror" name="jmls_omset1" value="{{ old('jmls_omset1') }}" required>
                                      @error('jmls_omset1')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputTigaJuta" class="form-label">Jumlah Siswa Mendapat Omset >1-3jt/Bulan</label>
                                      <input type="number" id="inputTigaJuta" class="form-control @error('jmls_omset2')
                                          is-invalid
                                      @enderror" name="jmls_omset2" value="{{ old('jmls_omset2') }}" required>
                                      @error('jmls_omset2')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputSatuJuta" class="form-label">Jumlah Siswa Mendapat Omset 500rb-1jt/Bulan</label>
                                      <input type="number" id="inputSatuJuta" class="form-control @error('jmls_omset3')
                                          is-invalid
                                      @enderror" name="jmls_omset3" value="{{ old('jmls_omset3') }}" required>
                                      @error('jmls_omset3')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputLimaRatus" class="form-label">Jumlah Siswa Mendapat Omset 500rb/Bulan </label>
                                      <input type="number" id="inputLimaRatus" class="form-control @error('jmls_omset4')
                                          is-invalid
                                      @enderror" name="jmls_omset4" value="{{ old('jmls_omset4') }}" required>
                                      @error('jmls_omset4')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="formFile" class="form-label">Upload Data(xls, xlsx)</label>
                                      <input class="form-control @error('data_excel')
                                          is-invalid
                                      @enderror" type="file" id="formFile" name="data_excel" required>
                                      @error('data_excel')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="tahunRekap" class="form-label">Tahun Rekap</label>
                                      <input class="form-control @error('tahun_rekap')
                                          is-invalid
                                      @enderror" type="number" id="tahunRekap" name="tahun_rekap" value="{{ old('tahun_rekap') }}" required>
                                      @error('tahun_rekap')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                </div>
                                  <div class="modal-footer mt-5">
                                      <a href="/sekolah/alumni" class="btn btn-dark me-1"><i class="bi bi-arrow-left me-1"></i>Kembali</a> 
                                      <button type="submit" class="btn btn-outline-dark me-1"><i class="bi bi-person-check-fill"></i> Tambah Data</button>
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