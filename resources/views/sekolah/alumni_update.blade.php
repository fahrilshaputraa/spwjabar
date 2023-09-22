@extends('layouts.sekolah')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/sekolah">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/sekolah/alumni">Pendataan Alumni</a></li>
          <li class="breadcrumb-item active">Edit Data Almuni</li>
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
                                <h5 class="card-title users">Edit Data Alumni</h5>
                                <p>Semua Data Siswa SPW Alumni yang ada di Sekolah</p>
                              </div>
                            </div>
                          </div>
                            <!-- <hr class="dropdown-header mb-3"> -->
                            <form class="row g-3" action="/sekolah/alumni/update" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-6">
                                    <div class="col-12 mb-4"> 
                                      <label class="form-label">Kab/Kota</label>
                                      <select id="EditmySelect1" style="width: 100%;" name="npsn_sekolah">
                                        <option value="{{ $sekolah[0]->npsn }}" selected>{{ $sekolah[0]->nama_sekolah }}</option>
                                      </select>
                                      @error('npsn_sekolah')
                                      <div style="font-size: 14px;" class="text-danger">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4"> 
                                      <label class="form-label" for="inputEditKepsek">Nama Kepala Sekolah</label>
                                      <input type="text" id="inputEditKepsek" class="form-control @error('nama_kepsek')
                                          is-invalid
                                      @enderror" name="nama_kepsek" value="{{$alumni->nama_kepsek}}" required>
                                      @error('nama_kepsek')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditEmail" class="form-label">Email Sekolah</label>
                                      <input type="email" id="inputEditEmail" class="form-control @error('email')
                                          is-invalid
                                      @enderror" name="email" value="{{$alumni->email}}" required>
                                      @error('email')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditNoHpSekolah" class="form-label">No Hp Sekolah</label>
                                      <input type="number" id="inputEditNoHpSekolah" class="form-control @error('no_hp_sekolah')
                                          is-invalid
                                      @enderror" name="no_hp_sekolah" value="{{$alumni->no_hp_sekolah}}" required>
                                      @error('no_hp_sekolah')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditNamaGuru" class="form-label">Nama Guru</label>
                                      <input type="text" id="inputEditNamaGuru" class="form-control @error('nama_guru')
                                          is-invalid
                                      @enderror" name="nama_guru" value="{{$alumni->nama_guru}}" required>
                                      @error('nama_guru')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditNip" class="form-label">NIP/NUPTK/NUPPPK</label>
                                      <input type="number" id="inputEditNip" class="form-control @error('nip')
                                          is-invalid
                                      @enderror" name="nip" value="{{$alumni->nip}}" required>
                                      @error('nip')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditNoHp" class="form-label">No Hp</label>
                                      <input type="number" id="inputEditNoHp" class="form-control @error('no_hp')
                                          is-invalid
                                      @enderror" name="no_hp" value="{{$alumni->no_hp}}" required>
                                      @error('no_hp')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditJmlSiswa" class="form-label">Jumlah Siswa SPW</label>
                                      <input type="number" id="inputEditJmlSiswa" class="form-control @error('jml_siswa_dibina')
                                          is-invalid
                                      @enderror" name="jml_siswa_dibina" value="{{$alumni->jml_siswa_dibina}}" required>
                                      @error('jml_siswa_dibina')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditJmlKonsisten" class="form-label">Jumlah Siswa Konsiten</label>
                                      <input type="number" id="inputEditJmlKonsisten" class="form-control @error('jml_siswa_konsisten')
                                          is-invalid
                                      @enderror" name="jml_siswa_konsisten" value="{{$alumni->jml_siswa_konsisten}}" required>
                                      @error('jml_siswa_konsisten')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-12 mb-4">
                                      <label for="inputEditSiswaNIB" class="form-label">Jumlah Siswa Memiliki NIB</label>
                                      <input type="number" id="inputEditSiswaNIB" class="form-control @error('jml_siswa_nib')
                                          is-invalid
                                      @enderror" name="jml_siswa_nib" value="{{$alumni->jml_siswa_nib}}" required>
                                      @error('jml_siswa_nib')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditSiswaUsaha" class="form-label">Jumlah Siswa Melanjutkan Usaha/Menjadi Pengusaha</label>
                                      <input type="number" id="inputEditSiswaUsaha" class="form-control @error('jmls_almni_pengusaha')
                                          is-invalid
                                      @enderror" name="jmls_almni_pengusaha" value="{{$alumni->jmls_almni_pengusaha}}" required>
                                      @error('jmls_almni_pengusaha')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditSiswaPirt" class="form-label">Jumlah Alumni Sudah Punya PIRT</label>
                                      <input type="number" id="inputEditSiswaPirt" class="form-control @error('jmls_almni_pirt')
                                          is-invalid
                                      @enderror" name="jmls_almni_pirt" value="{{$alumni->jmls_almni_pirt}}" required>
                                      @error('jmls_almni_pirt')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditTigaJutaPlus" class="form-label">Jumlah Siswa Mendapat Omset >3jt/Bulan</label>
                                      <input type="number" id="inputEditTigaJutaPlus" class="form-control @error('jmls_omset1')
                                          is-invalid
                                      @enderror" name="jmls_omset1" value="{{$alumni->jmls_omset1}}" required>
                                      @error('jmls_omset1')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditTigaJuta" class="form-label">Jumlah Siswa Mendapat Omset >1-3jt/Bulan</label>
                                      <input type="number" id="inputEditTigaJuta" class="form-control @error('jmls_omset2')
                                          is-invalid
                                      @enderror" name="jmls_omset2" value="{{$alumni->jmls_omset2}}" required>
                                      @error('jmls_omset2')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditSatuJuta" class="form-label">Jumlah Siswa Mendapat Omset 500rb-1jt/Bulan</label>
                                      <input type="number" id="inputEditSatuJuta" class="form-control @error('jmls_omset3')
                                          is-invalid
                                      @enderror" name="jmls_omset3" value="{{$alumni->jmls_omset3}}" required>
                                      @error('jmls_omset3')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="inputEditLimaRatus" class="form-label">Jumlah Siswa Mendapat Omset 500rb/Bulan </label>
                                      <input type="number" id="inputEditLimaRatus" class="form-control @error('jmls_omset4')
                                          is-invalid
                                      @enderror" name="jmls_omset4" value="{{$alumni->jmls_omset4}}" required>
                                      @error('jmls_omset4')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="formEditFile" class="form-label">Upload Data(xls, xlsx)</label>
                                      <input class="form-control @error('data_excel')
                                          is-invalid
                                      @enderror" type="file" id="formEditFile" name="data_excel">
                                      <small class="form-text text-muted">*pilihan akan di ganti bila diisi | Kosongkan jika tidak ingin diganti</small>
                                      @error('data_excel')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                      <label for="editTahunRekap" class="form-label">Tahun Rekap</label>
                                      <input class="form-control @error('tahun_rekap')
                                          is-invalid
                                      @enderror" type="number" id="editTahunRekap" name="tahun_rekap" value="{{$alumni->tahun_rekap}}" required>
                                      @error('tahun_rekap')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                    <input type="text" id="idRekap" name="id_rekap" value="{{$alumni->id_rekap}}" hidden>
                                    <input type="text" id="oldNpsn" name="old_npsn" value="{{$sekolah[0]->npsn}}" hidden>
                                    <input type="text" id="oldFile" name="old_file" value="{{$alumni->data_excel}}" hidden>
                                </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-dark me-1" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-1"></i>Kembali</button> 
                                      <button type="submit" class="btn btn-outline-dark me-1"><i class="bi bi-person-check-fill"></i> Edit Data</button>
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