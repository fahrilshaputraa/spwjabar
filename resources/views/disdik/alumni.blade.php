@extends('layouts.disdik')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/disdik">Home</a></li>
          <li class="breadcrumb-item">Data Siswa</li>
          <li class="breadcrumb-item active">Data Siswa SPW Alumni</li>
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
                                <h5 class="card-title users">Data Siswa SPW Alumni</h5>
                                <p>Semua Data Siswa SPW Alumni yang ada di Disdik Jabar!</p>
                              </div>
                              <div class="col btn-tamimport d-flex gap-1 justify-content-end">
                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#TambahData"
                                style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
                                  <i class="bi bi-person-plus-fill me-1 add-data"></i>
                                   Tambah Data
                                </button>
                                <a href="/disdik/export/alumni" class="btn btn-dark"
                                style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
                                  <i class="bi bi-box-arrow-up me-1"></i>
                                  Export
                                </a>
                              </div>
                            </div>
                          </div>
                            <!-- <hr class="dropdown-header mb-3"> -->
                            <table class="table datatable border">
                               <thead class="bg-secondary bg-opacity-10 border-0 text-secondary">
                                  <tr>
                                     <th scope="col">No</th>
                                     <th scope="col">Nama Sekolah</th>
                                     <th scope="col">Nama Kepsek</th>
                                     <th scope="col">Email Sekolah</th>
                                     <th scope="col">No Telp Sekolah</th>
                                     <th scope="col">Nama Guru</th>
                                     <th scope="col">NIP/NUPTK/NUPPPK</th>
                                     <th scope="col">No Hp</th>
                                     <th scope="col">Jml Siswa SPW</th>
                                     <th scope="col">Jml Siswa Konsisten</th>
                                     <th scope="col">Jml Siswa Memiliki NIB</th>
                                     <th scope="col">Jml Siswa Melanjutkan Usaha</th>
                                     <th scope="col">Jml Siswa Punya PIRT</th>
                                     <th scope="col">Jml Siswa Omset 3jt+/bln</th>
                                     <th scope="col">Jml Siswa Omset 1-3jt/bln</th>
                                     <th scope="col">Jml Siswa Omset 500rb-1jt/bln</th>
                                     <th scope="col">Jml Siswa Omset 500rb/bln </th>
                                     <th scope="col">File</th>
                                     <th scope="col">Tahun Rekap</th>
                                     <th scope="col">Opsi</th>
                                  </tr>
                               </thead>
                               <tbody>
                                  @foreach ($data as $d)
                                    <tr id="{{ $d->id_rekap }}">
                                      <th scope="row">{{ $loop->iteration }}</th>
                                      <td class="text-field">{{ $d->sekolah->nama_sekolah }}</td>
                                      <td class="text-field">{{ $d->nama_kepsek }}</td>
                                      <td class="text-field">{{ $d->email }}</td>
                                      <td class="text-field">{{ $d->no_hp_sekolah }}</td>
                                      <td class="text-field">{{ $d->nama_guru }}</td>
                                      <td class="text-field">{{ $d->nip }}</td>
                                      <td class="text-field">{{ $d->no_hp }}</td>
                                      <td class="text-field">{{ $d->jml_siswa_dibina }}</td>
                                      <td class="text-field">{{ $d->jml_siswa_konsisten }}</td>
                                      <td class="text-field">{{ $d->jml_siswa_nib }}</td>
                                      <td class="text-field">{{ $d->jmls_almni_pengusaha }}</td>
                                      <td class="text-field">{{ $d->jmls_almni_pirt }}</td>
                                      <td class="text-field">{{ $d->jmls_omset1 }}</td>
                                      <td class="text-field">{{ $d->jmls_omset2 }}</td>
                                      <td class="text-field">{{ $d->jmls_omset3 }}</td>
                                      <td class="text-field">{{ $d->jmls_omset4 }}</td>
                                      <td class="text-field"><a href="/Data Excel/{{ $d->data_excel }}">{{ $d->data_excel }}</a></td>
                                      <td class="text-field">{{ $d->tahun_rekap }}</td>
                                      <td>
                                        <button class="badge border-0 bg-warning text-dark" data-bs-toggle="modal" data-bs-target="#EditData" onclick="editRekap('{{ $d->id_rekap }}')">
                                          <i class="bx bx-edit-alt fs-6 mt-1"></i>
                                        </button>
                                        <button class="badge border-0 bg-danger" onclick="deleteRekap('{{ $d->id_rekap }}')">
                                          <i class="bx bxs-trash-alt fs-6 mt-1"></i>
                                        </button>
                                      </td>
                                    </tr>
                                  @endforeach
                               </tbody>
                            </table>
                         </div>
                      </div>
                  </div>
              </div>
          </div>
            <!-- Form Modal -->
              <div class="modal fade" id="TambahData" tabindex="-1">
                  <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-content">
                          <div class="modal-header bg-secondary-light">
                              <h3 class="modal-title">Tambah Data</h3>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form class="row g-3" action="/disdik/alumni/store" method="POST" enctype="multipart/form-data">
                                @csrf
                                  <div class="col-12"> 
                                    <label class="form-label">Kab/Kota</label>
                                    <select id="mySelect1" style="width: 100%;" name="npsn_sekolah">
                                      <option selected disabled>Pilih Sekolah</option>
                                      @foreach ($sekolah as $s)
                                          <option value="{{ $s->npsn }}">{{ $s->nama_sekolah }}</option>
                                      @endforeach
                                    </select>
                                    @error('npsn_sekolah')
                                    <div style="font-size: 14px;" class="text-danger">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                  <div class="col-12"> 
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="col-12">
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
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-1"></i>Kembali</button> 
                                      <button type="submit" class="btn btn-outline-dark me-1"><i class="bi bi-person-check-fill"></i> Tambah Data</button>
                                  </div>
                              </form>
                          </div>
                       </div>
                  </div>
              </div>
              {{-- Form Edit --}}
              <div class="modal fade" id="EditData" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header bg-secondary-light">
                            <h3 class="modal-title">Ubah Data</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3" action="/disdik/alumni/update" method="POST" enctype="multipart/form-data">
                              @csrf
                                <div class="col-12"> 
                                  <label class="form-label">Kab/Kota</label>
                                  <select id="EditmySelect1" style="width: 100%;" name="npsn_sekolah">
                                    <option selected disabled>Pilih Sekolah</option>
                                    @foreach ($sekolah as $s)
                                        <option value="{{ $s->npsn }}">{{ $s->nama_sekolah }}</option>
                                    @endforeach
                                  </select>
                                  @error('npsn_sekolah')
                                  <div style="font-size: 14px;" class="text-danger">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12"> 
                                  <label class="form-label" for="inputEditKepsek">Nama Kepala Sekolah</label>
                                  <input type="text" id="inputEditKepsek" class="form-control @error('nama_kepsek')
                                      is-invalid
                                  @enderror" name="nama_kepsek" required>
                                  @error('nama_kepsek')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditEmail" class="form-label">Email Sekolah</label>
                                  <input type="email" id="inputEditEmail" class="form-control @error('email')
                                      is-invalid
                                  @enderror" name="email" required>
                                  @error('email')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditNoHpSekolah" class="form-label">No Hp Sekolah</label>
                                  <input type="number" id="inputEditNoHpSekolah" class="form-control @error('no_hp_sekolah')
                                      is-invalid
                                  @enderror" name="no_hp_sekolah" required>
                                  @error('no_hp_sekolah')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditNamaGuru" class="form-label">Nama Guru</label>
                                  <input type="text" id="inputEditNamaGuru" class="form-control @error('nama_guru')
                                      is-invalid
                                  @enderror" name="nama_guru" required>
                                  @error('nama_guru')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditNip" class="form-label">NIP/NUPTK/NUPPPK</label>
                                  <input type="number" id="inputEditNip" class="form-control @error('nip')
                                      is-invalid
                                  @enderror" name="nip" required>
                                  @error('nip')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditNoHp" class="form-label">No Hp</label>
                                  <input type="number" id="inputEditNoHp" class="form-control @error('no_hp')
                                      is-invalid
                                  @enderror" name="no_hp" required>
                                  @error('no_hp')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditJmlSiswa" class="form-label">Jumlah Siswa SPW</label>
                                  <input type="number" id="inputEditJmlSiswa" class="form-control @error('jml_siswa_dibina')
                                      is-invalid
                                  @enderror" name="jml_siswa_dibina" required>
                                  @error('jml_siswa_dibina')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditJmlKonsisten" class="form-label">Jumlah Siswa Konsiten</label>
                                  <input type="number" id="inputEditJmlKonsisten" class="form-control @error('jml_siswa_konsisten')
                                      is-invalid
                                  @enderror" name="jml_siswa_konsisten" required>
                                  @error('jml_siswa_konsisten')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditSiswaNIB" class="form-label">Jumlah Siswa Memiliki NIB</label>
                                  <input type="number" id="inputEditSiswaNIB" class="form-control @error('jml_siswa_nib')
                                      is-invalid
                                  @enderror" name="jml_siswa_nib" required>
                                  @error('jml_siswa_nib')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditSiswaUsaha" class="form-label">Jumlah Siswa Melanjutkan Usaha/Menjadi Pengusaha</label>
                                  <input type="number" id="inputEditSiswaUsaha" class="form-control @error('jmls_almni_pengusaha')
                                      is-invalid
                                  @enderror" name="jmls_almni_pengusaha" required>
                                  @error('jmls_almni_pengusaha')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditSiswaPirt" class="form-label">Jumlah Alumni Sudah Punya PIRT</label>
                                  <input type="number" id="inputEditSiswaPirt" class="form-control @error('jmls_almni_pirt')
                                      is-invalid
                                  @enderror" name="jmls_almni_pirt" required>
                                  @error('jmls_almni_pirt')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditTigaJutaPlus" class="form-label">Jumlah Siswa Mendapat Omset >3jt/Bulan</label>
                                  <input type="number" id="inputEditTigaJutaPlus" class="form-control @error('jmls_omset1')
                                      is-invalid
                                  @enderror" name="jmls_omset1" required>
                                  @error('jmls_omset1')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditTigaJuta" class="form-label">Jumlah Siswa Mendapat Omset >1-3jt/Bulan</label>
                                  <input type="number" id="inputEditTigaJuta" class="form-control @error('jmls_omset2')
                                      is-invalid
                                  @enderror" name="jmls_omset2" required>
                                  @error('jmls_omset2')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditSatuJuta" class="form-label">Jumlah Siswa Mendapat Omset 500rb-1jt/Bulan</label>
                                  <input type="number" id="inputEditSatuJuta" class="form-control @error('jmls_omset3')
                                      is-invalid
                                  @enderror" name="jmls_omset3" required>
                                  @error('jmls_omset3')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="inputEditLimaRatus" class="form-label">Jumlah Siswa Mendapat Omset 500rb/Bulan </label>
                                  <input type="number" id="inputEditLimaRatus" class="form-control @error('jmls_omset4')
                                      is-invalid
                                  @enderror" name="jmls_omset4" required>
                                  @error('jmls_omset4')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="formEditFile" class="form-label">Upload Data(xls, xlsx)</label>
                                  <input class="form-control @error('data_excel')
                                      is-invalid
                                  @enderror" type="file" id="formEditFile" name="data_excel">
                                  @error('data_excel')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <div class="col-12">
                                  <label for="editTahunRekap" class="form-label">Tahun Rekap</label>
                                  <input class="form-control @error('tahun_rekap')
                                      is-invalid
                                  @enderror" type="number" id="editTahunRekap" name="tahun_rekap" required>
                                  @error('tahun_rekap')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                                <input type="text" id="idRekap" name="id_rekap" hidden>
                                <input type="text" id="oldNpsn" name="old_npsn" hidden>
                                <input type="text" id="oldFile" name="old_file" hidden>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-1"></i>Kembali</button> 
                                    <button type="submit" class="btn btn-outline-dark me-1"><i class="bi bi-person-check-fill"></i> Tambah Data</button>
                                </div>
                            </form>
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
    });
    function editRekap(id){
      $.ajax({
          url: `/disdik/getAlumni`,
          type: "GET",
          data: {id:id},
          cache: false,
          success:function(response){
            console.log(response);
              $('#inputEditKepsek').val(response[0].nama_kepsek);
              $('#inputEditEmail').val(response[0].email);
              $('#inputEditNoHpSekolah').val(response[0].no_hp_sekolah);
              $('#inputEditNamaGuru').val(response[0].nama_guru);
              $('#inputEditNip').val(response[0].nip);
              $('#inputEditNoHp').val(response[0].no_hp);
              $('#inputEditJmlSiswa').val(response[0].jml_siswa_dibina);
              $('#inputEditJmlKonsisten').val(response[0].jml_siswa_konsisten);
              $('#inputEditSiswaNIB').val(response[0].jml_siswa_nib);
              $('#inputEditSiswaUsaha').val(response[0].jmls_almni_pengusaha);
              $('#inputEditSiswaPirt').val(response[0].jmls_almni_pirt);
              $('#inputEditTigaJutaPlus').val(response[0].jmls_omset1);
              $('#inputEditTigaJuta').val(response[0].jmls_omset2);
              $('#inputEditSatuJuta').val(response[0].jmls_omset3);
              $('#inputEditLimaRatus').val(response[0].jmls_omset4);
              $('#editTahunRekap').val(response[0].tahun_rekap);
              $('#idRekap').val(response[0].id_rekap);
              $('#oldNpsn').val(response[0].npsn_sekolah);
              $('#oldFile').val(response[0].data_excel);
          }
      });
    }
    function deleteRekap(id){
      Swal.fire({
        title: "Apa kamu yakin?",
        text: "Kamu yakin untuk menghapus data ini",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus",
        cancelButtonText: "Batal",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type:'POST',
            url:'/disdik/alumni/destroy',
            data:{
                "_token": "{{ csrf_token() }}",
                id:id
            },
            success:function(data) {
              if (data){
                    Swal.fire("Hapus!", "Kamu berhasil menghapus data ini.", "success");
                    $("#"+id).remove();
                }
            }
          });
          
        }
      });
    }
 </script>
@endsection