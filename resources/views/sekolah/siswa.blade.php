@extends('layouts.sekolah')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/sekolah">Dashboard</a></li>
          <li class="breadcrumb-item active">Data Siswa SPW</li>
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
                                <h5 class="card-title users">Data Siswa</h5>
                                <p>Semua Siswa SPW yang ada di Disdik Jabar!</p>
                              </div>
                              <div class="col btn-tamimport d-flex gap-1 justify-content-end">
                                <a href="/sekolah/siswa.insert" class="btn btn-outline-dark"
                                style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
                                  <i class="bi bi-person-plus-fill me-1 add-data"></i>
                                   Tambah Data
                                </a>
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#uploadFile"
                                style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
                                  <i class="bi bi-box-arrow-in-down me-1"></i>
                                   Import
                                </button>
                                <a href="/sekolah/export/siswa" class="btn btn-dark"
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
                                     <th scope="col">NISN</th>
                                     <th scope="col">Nama Lengkap</th>
                                     <th scope="col">No.Hp</th>
                                     <th scope="col">Asal KCD</th>
                                     <th scope="col">Kab/Kota</th>
                                     <th scope="col">Asal Sekolah</th>
                                     <th scope="col">Nama Kepsek</th>
                                     <th scope="col">Kelas</th>
                                     <th scope="col">Jurusan</th>
                                     <th scope="col">Jenis Usaha</th>
                                     <th scope="col">Merk Brand</th>
                                     <th scope="col">Tempat Berjualan</th>
                                     <th scope="col">Total Omset</th>
                                     <th scope="col">NIB</th>
                                     <th scope="col">Tahun Rekap</th>
                                     <th scope="col">Laporan Keuangan</th>
                                     <th scope="col">Informasi Produk</th>
                                     <th scope="col">Opsi</th>
                                  </tr>
                               </thead>
                               <tbody>
                                @foreach ($data as $d)
                                <tr id="{{ $d->nisn }}">
                                   <th scope="row">{{ $loop->iteration }}</th>
                                   <td class="text-field">{{ $d->nisn }}</td>
                                   <td class="text-field">{{ $d->nama_lengkap }}</td>
                                   <td class="text-field">{{ $d->no_hp }}</td>
                                   <td class="text-field">{{ $d->sekolah->kab->kcd->singkatan }}</td>
                                   <td class="text-field">{{ $d->sekolah->kab->nama_kab }}</td>
                                   <td class="text-field">{{ $d->sekolah->nama_sekolah }}</td>
                                   <td class="text-field">{{ $d->nama_kepsek }}</td>
                                   <td class="text-field">{{ $d->kelas }}</td>
                                   <td class="text-field">{{ $d->jurusan }}</td>
                                   <td class="text-field">{{ $d->jenis_usaha }}</td>
                                   <td class="text-field">{{ $d->merk_brand }}</td>
                                   <td class="text-field">{{ $d->tempat_berjualan }}</td>
                                   <td class="text-field">@currency($d->omset)</td>
                                   <td class="text-field">{{ $d->nib }}</td>
                                   <td class="text-field">{{ $d->tahun_rekap }}</td>
                                   <td class="text-field"><a href="/Laporan Keuangan/{{ $d->laporan_keuangan }}" target="_blank">Lihat</a></td>
                                   <td class="text-field"><a data-bs-toggle="modal" data-bs-target="#lihatProduk" class="text-warning" onclick="lihatProduk('{{ $d->nisn }}')">Lihat</a></td>
                                   <td>
                                    {{-- <button class="badge border-0 bg-warning text-dark" data-bs-toggle="modal" data-bs-target="#EditData">
                                      <i class="bx bx-edit-alt fs-6 mt-1" onclick="editSiswa('{{ $d->nisn }}')"></i>
                                    </button> --}}
                                    <a href="/sekolah/siswa.update.{{ $d->nisn }}" class="badge border-0 bg-warning text-dark"><i class="bx bx-edit-alt fs-6 mt-1"></i></a>
                                    <button class="badge border-0 bg-danger" onclick="deleteSiswa('{{ $d->nisn }}', '{{ $d->npsn_sekolah }}')">
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
            {{-- Form Tambah --}}
            <div class="modal fade" id="TambahData" tabindex="-1">
                  <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-content">
                          <div class="modal-header bg-secondary-light">
                              <h3 class="modal-title">Tambah Data</h3>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form class="row g-3" action="/sekolah/siswa/store" method="POST" enctype="multipart/form-data">
                                @csrf
                                  <div class="col-12">  
                                      <label for="inputNISN" class="form-label">NISN</label> 
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
                                  <div class="col-12"> 
                                      <label for="inputNamaLengkap" class="form-label">Nama Lengkap</label> 
                                      <input type="text" class="form-control @error('nama_lengkap')
                                          is-invalid
                                      @enderror" id="inputNamaLengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                      @error('nama_lengkap')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12"> 
                                      <label for="inputNoHp" class="form-label">No Hp</label> 
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
                                  <div class="col-12"> 
                                      <label for="inputKelas" class="form-label">Kelas</label> 
                                      <input type="text" class="form-control @error('kelas')
                                          is-invalid
                                      @enderror" id="inputKelas" name="kelas" value="{{ old('kelas') }}" required>
                                      @error('kelas')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12"> 
                                      <label for="inputJurusan" class="form-label">Jurusan</label> 
                                      <input type="text" class="form-control @error('jurusan')
                                          is-invalid
                                      @enderror" id="inputJurusan" name="jurusan" value="{{ old('jurusan') }}" required>
                                      @error('jurusan')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12">
                                      <label for="id_kcd" class="form-label">Kantor Cabang Dinas (KCD)</label>
                                      <select id="id_kcd" style="width: 100%;" name="id_kcd">
                                        <option value="{{ $sekolah[0]->kab->kcd->id }}" selected>{{ $sekolah[0]->kab->kcd->nama_kcd }}</option>
                                      </select>
                                      @error('id_kcd')
                                      <div style="font-size: 14px;" class="text-danger">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12">
                                      <label for="id_kab" class="form-label">Kabupaten/Kota</label>
                                      <select id="id_kab" style="width: 100%;" name="id_kab">
                                        <option value="{{ $sekolah[0]->kab->id}}" selected>{{ $sekolah[0]->kab->nama_kab }}</option>
                                      </select>
                                      @error('id_kab')
                                      <div style="font-size: 14px;" class="text-danger">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12">
                                      <label for="npsn_sekolah" class="form-label">Sekolah</label>
                                      <select id="npsn_sekolah" style="width: 100%;" name="npsn_sekolah">
                                        <option value="{{ $sekolah[0]->npsn}}" selected>{{ $sekolah[0]->nama_sekolah }}</option>
                                      </select>
                                      @error('npsn_sekolah')
                                      <div style="font-size: 14px;" class="text-danger">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12"> 
                                    <label for="inputNamaKepsek" class="form-label">Nama Kepala Sekolah</label> 
                                    <input type="text" class="form-control @error('nama_kepsek')
                                        is-invalid
                                    @enderror" id="inputNamaKepsek" name="nama_kepsek" value="{{ old('nama_kepsek') }}" required>
                                    @error('nama_kepsek')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                  <div class="col-12">
                                      <label class="form-label">Jenis Usaha</label>
                                      <div class="form-group">
                                          <div class="radio">
                                          <label class="radio-inline control-label mb-2">
                                            <input type="radio" class="form-check-input" id="radioKuliner" name="jenis_usaha" value="Kuliner" />
                                            Kuliner
                                          </label>
                                      </div>
                                      <div class="form-group">
                                        <label class="radio-inline control-label mb-2">
                                          <input type="radio" class="form-check-input" id="radioFashion" name="jenis_usaha" value="Fashion" />
                                         Fashion
                                        </label>
                                      </div>
                                      <div class="form-group">
                                        <label class="radio-inline control-label mb-2">
                                          <input type="radio" class="form-check-input" id="radioKosmetik" name="jenis_usaha" value="Kosmetik" />
                                          Kosmetik
                                        </label>
                                      </div>
                                      <div class="form-group other">
                                        <label class="radio-inline control-label mb-2">
                                          <input type="radio" class="form-check-input" id="radioLainnya" name="jenis_usaha" value="Lainnya" />
                                          Lainnya
                                        </label>
                                        <input type="text" class="form-control form-other " id="usahaLainnya" name="usahaLainnya" data-rule-required="true" contenteditable="false"/>
                                      </div>
                                      @error('jenis_usaha')
                                      <div style="font-size: 14px;" class="text-danger">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-12"> 
                                      <label for="inpuMerkBrand" class="form-label">Nama Merk/Brand</label>
                                      <input type="text" class="form-control @error('merk_brand')
                                          is-invalid
                                      @enderror" id="inpuMerkBrand" name="merk_brand" value="{{ old('merk_brand') }}" required>
                                      @error('merk_brand')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12">
                                    <label class="form-label">Tempat Berjualan</label> 
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Instagram" id="checkInstagram" name="tempat_berjualan[]">
                                      <label class="form-check-label mb-1" for="checkInstagram">
                                        Instagram
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Whatsapp" id="checkWhatsapp" name="tempat_berjualan[]">
                                      <label class="form-check-label mb-1" for="checkWhatsapp">
                                        Whatsapp
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Facebook" id="checkFacebook" name="tempat_berjualan[]">
                                      <label class="form-check-label mb-1" for="checkFacebook">
                                        Facebook
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Shopee" id="checkShopee" name="tempat_berjualan[]">
                                      <label class="form-check-label mb-1" for="checkShopee">
                                        Shopee
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Lazada" id="checkLazada" name="tempat_berjualan[]">
                                      <label class="form-check-label mb-1" for="checkLazada">
                                        Lazada
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Tokopedia" id="checkTokopedia" name="tempat_berjualan[]">
                                      <label class="form-check-label mb-1" for="checkTokopedia">
                                        Tokopedia
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="Bukalapak" id="checkBukapalak" name="tempat_berjualan[]">
                                      <label class="form-check-label mb-1" for="checkBukapalak">
                                        Bukalapak
                                      </label>
                                    </div>
                                    <div class="form-check other">
                                        <label class="radio-inline control-label mb-1">
                                          <input type="checkbox" class="form-check-input" id="checkLainnya" name="tempat_berjualan[]" value="Lainnya" />
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
                                  <div class="col-12"> 
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
                                  <div class="col-12"> 
                                    <label for="inputOmset" class="form-label">Omset</label> 
                                    <input type="text" class="form-control @error('omset')
                                        is-invalid
                                    @enderror" id="inputOmset"  value="{{ old('omset') }}" required>
                                    @error('omset')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror 
                                    <input type="text" class="form-control" hidden id="rupiah" name="omset">
                                  </div>
                                  <div class="col-12">
                                      <label for="inputYear" class="form-label">Tahun Rekap</label>
                                      <input type="number" class="form-control @error('tahun_rekap')
                                          is-invalid
                                      @enderror" id="inputYear" name="tahun_rekap" value="{{ old('tahun_rekap') }}" required>
                                      @error('tahun_rekap')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12">
                                    <label for="formFileLaporan" class="form-label">Upload Laporan Keuangan(pdf)</label>
                                    <input class="form-control @error('laporan_keuangan')
                                        is-invalid
                                    @enderror" type="file" id="formFileLaporan" name="laporan_keuangan">
                                    @error('laporan_keuangan')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                  <div class="col-12">
                                    <label for="formFileFoto" class="form-label">Upload Foto Produk(jpg, jpeg, png)</label>
                                    <input class="form-control @error('foto_produk')
                                        is-invalid
                                    @enderror" type="file" id="formFileFoto" name="foto_produk">
                                    @error('foto_produk')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                  <div class="col-12">
                                    <label for="inputDeskripsi">Deskripsi Produk</label>
                                    <textarea class="form-control @error('deskripsi_produk')
                                        is-invalid
                                    @enderror" id="inputDeskripsi" rows="3" name="deskripsi_produk" required>{{ old('deskripsi_produk') }}</textarea>
                                    @error('deskripsi_produk')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-1"></i>Kembali</button> 
                                      <button type="sumbit" class="btn btn-outline-dark me-1"><i class="bi bi-person-check-fill"></i> Tambah Data</button>
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
                          <form class="row g-3" action="/sekolah/siswa/update" method="POST" enctype="multipart/form-data">
                            @csrf
                              <div class="col-12"> 
                                  <label for="inputEditNISN" class="form-label">NISN</label> 
                                  <input type="number" class="form-control @error('nisn')
                                      is-invalid
                                  @enderror" id="inputEditNISN" name="nisn" required readonly>
                                  @error('nisn')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12"> 
                                  <label for="inputEditNamaLengkap" class="form-label">Nama Lengkap</label> 
                                  <input type="text" class="form-control @error('nama_lengkap')
                                      is-invalid
                                  @enderror" id="inputEditNamaLengkap" name="nama_lengkap" required>
                                  @error('nama_lengkap')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12"> 
                                  <label for="inputEditNoHp" class="form-label">No Hp</label> 
                                  <input type="number" placeholder="08**********" class="form-control mb-1 @error('no_hp')
                                      is-invalid
                                  @enderror" onKeyPress="if(this.value.length==12) return false;" id="inputEditNoHp" name="no_hp" required>
                                  <small class="form-text text-muted" id="alertEditNoHp"></small>
                                  @error('no_hp')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12"> 
                                  <label for="inputEditKelas" class="form-label">Kelas</label> 
                                  <input type="text" class="form-control @error('kelas')
                                      is-invalid
                                  @enderror" id="inputEditKelas" name="kelas" required>
                                  @error('kelas')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12"> 
                                  <label for="inputEditJurusan" class="form-label">Jurusan</label> 
                                  <input type="text" class="form-control @error('jurusan')
                                      is-invalid
                                  @enderror" id="inputEditJurusan" name="jurusan" required>
                                  @error('jurusan')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12">
                                  <label for="id_kcd_edit" class="form-label">Kantor Cabang Dinas (KCD)</label>
                                  <select id="id_kcd_edit" style="width: 100%;" name="id_kcd">
                                    <option value="{{ $sekolah[0]->kab->kcd->id }}" selected>{{ $sekolah[0]->kab->kcd->nama_kcd }}</option>
                                  </select>
                                  @error('id_kcd')
                                  <div style="font-size: 14px;" class="text-danger">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12">
                                  <label for="id_kab_edit" class="form-label">Kabupaten/Kota</label>
                                  <select id="id_kab_edit" style="width: 100%;" name="id_kab">
                                    <option value="{{ $sekolah[0]->kab->id}}" selected>{{ $sekolah[0]->kab->nama_kab }}</option>
                                  </select>
                                  @error('id_kab')
                                  <div style="font-size: 14px;" class="text-danger">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12">
                                  <label for="npsn_sekolah_edit" class="form-label">Sekolah</label>
                                  <select id="npsn_sekolah_edit" style="width: 100%;" name="npsn_sekolah">
                                    <option value="{{ $sekolah[0]->npsn}}" selected>{{ $sekolah[0]->nama_sekolah }}</option>
                                  </select>
                                  @error('npsn_sekolah')
                                  <div style="font-size: 14px;" class="text-danger">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12"> 
                                <label for="inputEditNamaKepsek" class="form-label">Nama Kepala Sekolah</label> 
                                <input type="text" class="form-control @error('nama_kepsek')
                                    is-invalid
                                @enderror" id="inputEditNamaKepsek" name="nama_kepsek" required>
                                @error('nama_kepsek')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                              <div class="col-12">
                                  <label class="form-label">Jenis Usaha</label>
                                  <div class="form-group">
                                      <div class="radio">
                                      <label class="radio-inline control-label mb-2">
                                        <input type="radio" class="form-check-input" id="editRadioKuliner" name="jenis_usaha" value="Kuliner" />
                                        Kuliner
                                      </label>
                                  </div>
                                  <div class="form-group">
                                    <label class="radio-inline control-label mb-2">
                                      <input type="radio" class="form-check-input" id="editRadioFashion" name="jenis_usaha" value="Fashion" />
                                     Fashion
                                    </label>
                                  </div>
                                  <div class="form-group">
                                    <label class="radio-inline control-label mb-2">
                                      <input type="radio" class="form-check-input" id="editRadioKosmetik" name="jenis_usaha" value="Kosmetik" />
                                      Kosmetik
                                    </label>
                                  </div>
                                  <div class="form-group other">
                                    <label class="radio-inline control-labe mb-2">
                                      <input type="radio" class="form-check-input" id="editRadioLainnya" name="jenis_usaha" value="Lainnya" />
                                      Lainnya
                                    </label>
                                    <input type="text" class="form-control form-other" id="editUsahaLainnya" name="usahaLainnya" data-rule-required="true" contenteditable="false"/>
                                  </div>
                                <small class="form-text text-muted">*pilihan akan di ganti bila diisi | Kosongkan jika tidak ingin diganti</small>
                                  @error('jenis_usaha')
                                  <div style="font-size: 14px;" class="text-danger">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                              </div>
                              <div class="col-12"> 
                                  <label for="inputEditMerkBrand" class="form-label">Nama Merk/Brand</label>
                                  <input type="text" class="form-control @error('merk_brand')
                                      is-invalid
                                  @enderror" id="inputEditMerkBrand" name="merk_brand" value="{{ old('merk_brand') }}" required>
                                  @error('merk_brand')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12">
                                <label class="form-label">Tempat Berjualan</label> 
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Instagram" id="editCheckInstagram" name="tempat_berjualan[]">
                                  <label class="form-check-label mb-1" for="editCheckInstagram">
                                    Instagram
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Whatsapp" id="editCheckWhatsapp" name="tempat_berjualan[]">
                                  <label class="form-check-label mb-1" for="editCheckWhatsapp">
                                    Whatsapp
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Facebook" id="editCheckFacebook" name="tempat_berjualan[]">
                                  <label class="form-check-label mb-1" for="editCheckFacebook">
                                    Facebook
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Shopee" id="editCheckShopee" name="tempat_berjualan[]">
                                  <label class="form-check-label mb-1" for="editCheckShopee">
                                    Shopee
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Lazada" id="editCheckLazada" name="tempat_berjualan[]">
                                  <label class="form-check-label mb-1" for="editCheckLazada">
                                    Lazada
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Tokopedia" id="editCheckTokopedia" name="tempat_berjualan[]">
                                  <label class="form-check-label mb-1" for="editCheckTokopedia">
                                    Tokopedia
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="Bukalapak" id="editCheckBukapalak" name="tempat_berjualan[]">
                                  <label class="form-check-label mb-1" for="editCheckBukapalak">
                                    Bukalapak
                                  </label>
                                </div>
                                <div class="form-check other">
                                    <label class="radio-inline control-label mb-1">
                                      <input type="checkbox" class="form-check-input" id="editCheckLainnya" name="tempat_berjualan[]" value="Lainnya" />
                                      Lainnya
                                    </label>
                                    <input type="text" class="form-control form-other" id="editTempatLainnya" name="tempatLainnya" data-rule-required="true" contenteditable="false"/>
                                </div>
                                <small class="form-text text-muted">*pilihan akan di ganti bila diisi | Kosongkan jika tidak ingin diganti</small>
                                @error('tempat_berjualan')
                                <div style="font-size: 14px;" class="text-danger">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                              <div class="col-12"> 
                                <label for="inputEditNib" class="form-label">NIB</label> 
                                <input type="number" maxlength="6" class="form-control @error('nib')
                                    is-invalid
                                @enderror" id="inputEditNib" name="nib">
                                @error('nib')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                              <div class="col-12"> 
                                <label for="inputEditOmset" class="form-label">Omset</label> 
                                <input type="text" class="form-control @error('omset')
                                    is-invalid
                                @enderror" id="inputEditOmset" name="omset" required>
                                @error('omset')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                                <input type="text" class="form-control" hidden id="rupiahEdit" name="omset">
                              </div>
                              <div class="col-12">
                                  <label for="inputEditYear" class="form-label">Tahun Rekap</label>
                                  <input type="number" class="form-control @error('tahun_rekap')
                                      is-invalid
                                  @enderror" id="inputEditYear" name="tahun_rekap" value="{{ old('tahun_rekap') }}" required>
                                  @error('tahun_rekap')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12">
                                <label for="formEditFileLaporan" class="form-label">Upload Laporan Keuangan(pdf)</label>
                                <input class="form-control @error('laporan_keuangan')
                                    is-invalid
                                @enderror" type="file" id="formEditFileLaporan" name="laporan_keuangan"/>
                                <small class="form-text text-muted">*pilihan akan di ganti bila diisi | Kosongkan jika tidak ingin diganti</small>
                                @error('laporan_keuangan')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                              <div class="col-12">
                                <label for="formEditFileFoto" class="form-label">Upload Foto Produk(jpg, jpeg, png)</label>
                                <input class="form-control @error('foto_produk')
                                    is-invalid
                                @enderror" type="file" id="formEditFileFoto" name="foto_produk"/>
                                <small class="form-text text-muted">*pilihan akan di ganti bila diisi | Kosongkan jika tidak ingin diganti</small>
                                @error('foto_produk')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                              </div>
                              <div class="col-12">
                                <label for="inputEditDeskripsi">Deskripsi Produk</label>
                                <textarea class="form-control @error('deskripsi_produk')
                                    is-invalid
                                @enderror" id="inputEditDeskripsi" rows="3" name="deskripsi_produk" required>{{ old('deskripsi_produk') }}</textarea>
                                @error('deskripsi_produk')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                                @enderror
                                <input type="text" name="old_laporan" id="oldLaporan" value="" hidden>
                                <input type="text" name="old_foto" id="oldFoto" value="" hidden>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-1"></i>Kembali</button> 
                                  <button type="sumbit" class="btn btn-outline-dark me-1"><i class="bi bi-person-check-fill"></i> Tambah Data</button>
                              </div>
                          </form>
                      </div>
                   </div>
              </div>
            </div>
            {{-- Upload File --}}
            <div class="modal fade" id="uploadFile" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header border-0">
                              <h5 class="modal-title">Upload File</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body border-upload">
                               <form action="/sekolah/import/siswa" method="POST" enctype="multipart/form-data">
                                @csrf
                                  <h4 class="text-center">Pilih file disini</h4>
                                  <p class="text-field text-center">Files Supported: .xls, .xlsx</p>
                                  <input type="file" id="files" name="file_excel" multiple="multiple" class="border-bottom" />
                                  {{-- <div class="input-group custom-file-button">
                                    <label class="input-group-text" for="inputGroupFile">Your Custom Text</label>
                                    <input type="file" class="form-control" id="inputGroupFile">
                                  </div> --}}
                                  <div class="modal-footer justify-content-center mt-3 border-0 d-smnon">
                                      <button type="submit" class="btn btn-dark">
                                          <i class="bi bi-box-arrow-in-down me-1"></i>
                                          Import
                                      </button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
            </div>
            {{-- Lihat Produk --}}
            <div class="modal fade" id="lihatProduk" tabindex="-1">
              <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                      <div class="modal-header bg-secondary-light">
                          <h3 class="modal-title">Informasi Produk</h3>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <img class="img-fluid rounded" id="imgProduk">
                        <h5 class="mt-3 fw-bold">Deskripsi Produk: </h5>
                        <p id="deskripsiProduk" class="lead"></p>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-1"></i>Kembali</button> 
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
    });



    $(function () {
        $('#id_kcd').on('change', function () {
          console.log($(this).val());
            $.ajax({
                url: '/sekolah/getKabs',
                type: 'GET',
                data: {
                    id: $(this).val()
                },
                success: function (data) {
                    console.log(data);
                    $('#npsn_sekolah').empty();
                    $('#npsn_sekolah').append("<option selected disabled>Pilih Sekolah</option>");
                    $('#id_kab').empty();
                    $('#id_kab').append("<option selected disabled>Pilih Kab/Kot</option>");
                    $.each(data, function (key, value) {
                        $('#id_kab').append('<option value="' + value.id + '">' + value.nama_kab + '</option>');
                    });
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $('#id_kab').on('change', function () {
            $.ajax({
                url: '/sekolah/getSekolahs',
                type: 'GET',
                data: {
                    id: $(this).val()
                },
                success: function (data) {
                    $('#npsn_sekolah').empty();
                    $('#npsn_sekolah').append("<option selected disabled>Pilih Sekolah</option>");
                    $.each(data, function (key, value) {
                        $('#npsn_sekolah').append('<option value="' + value.npsn + '">' + value.nama_sekolah + '</option>');
                    });
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    });



    $(function () {
        $('#id_kcd_edit').on('change', function () {
          console.log($(this).val());
            $.ajax({
                url: '/sekolah/getKabs',
                type: 'GET',
                data: {
                    id: $(this).val()
                },
                success: function (data) {
                    console.log(data);
                    $('#npsn_sekolah_edit').empty();
                    $('#npsn_sekolah_edit').append("<option selected disabled>Pilih Sekolah</option>");
                    $('#id_kab_edit').empty();
                    $('#id_kab_edit').append("<option selected disabled>Pilih Kab/Kot</option>");
                    $.each(data, function (key, value) {
                        $('#id_kab_edit').append('<option value="' + value.id + '">' + value.nama_kab + '</option>');
                    });
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
        $('#id_kab_edit').on('change', function () {
            $.ajax({
                url: '/sekolah/getSekolahs',
                type: 'GET',
                data: {
                    id: $(this).val()
                },
                success: function (data) {
                    $('#npsn_sekolah_edit').empty();
                    $('#npsn_sekolah_edit').append("<option selected disabled>Pilih Sekolah</option>");
                    $.each(data, function (key, value) {
                        $('#npsn_sekolah_edit').append('<option value="' + value.npsn + '">' + value.nama_sekolah + '</option>');
                    });
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    });

    function editSiswa(nisn){
      $.ajax({
          url: `/sekolah/getSiswa`,
          type: "GET",
          data: {id:nisn},
          cache: false,
          success:function(response){
              $('#inputEditNISN').val(response[0].nisn);
              $('#inputEditNamaLengkap').val(response[0].nama_lengkap);
              $('#inputEditNoHp').val(response[0].no_hp);
              $('#inputEditKelas').val(response[0].kelas);
              $('#inputEditJurusan').val(response[0].jurusan);
              $('#inputEditNamaKepsek').val(response[0].nama_kepsek);
              $('#inputEditMerkBrand').val(response[0].merk_brand);
              $('#inputEditNib').val(response[0].nib);
              $('#inputEditOmset').val(response[0].omset);
              $('#inputEditYear').val(response[0].tahun_rekap);
              $('#inputEditDeskripsi').text(response[0].deskripsi_produk);
              $('#oldLaporan').val(response[0].laporan_keuangan);
              $('#oldFoto').val(response[0].foto_produk);
          }
      });
    }
    function deleteSiswa(id, npsn){
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
          console.log(id, npsn);
          $.ajax({
            type:'POST',
            url:'/sekolah/siswa/destroy',
            data:{
                "_token": "{{ csrf_token() }}",
                id:id,
                npsn_sekolah:npsn
            },
            success:function(data) {
              console.log(data);
              if (data){
                    Swal.fire("Hapus!", "Kamu berhasil menghapus data ini.", "success");
                    $("#"+id).remove();
              }
            }
          });
          
        }
      });
    }
    function lihatProduk(nisn){
      $.ajax({
          url: `/sekolah/getSiswa`,
          type: "GET",
          data: {id:nisn},
          cache: false,
          success:function(response){
            console.log(response[0]);
              $('#imgProduk').attr('src','/Foto Produk/'+response[0].foto_produk);
              $('#deskripsiProduk').text(response[0].deskripsi_produk);
          }
      });
    }
</script>
@endsection