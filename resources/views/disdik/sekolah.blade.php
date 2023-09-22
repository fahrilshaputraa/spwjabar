@extends('layouts.disdik')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active">Data Sekolah</li>
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
                                <h5 class="card-title users">Data Sekolah</h5>
                                <p>Semua Sekolah yang ada di Disdik Jabar!</p>
                              </div>
                              <div class="col btn-tamimport d-flex gap-1 justify-content-end">
                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#TambahData"
                                style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
                                  <i class="bi bi-person-plus-fill me-1 add-data"></i>
                                   Tambah Data
                                </button>
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#uploadFile"
                                style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
                                  <i class="bi bi-box-arrow-in-down me-1"></i>
                                   Import
                                </button>
                                <a href="/disdik/export/sekolah"  class="btn btn-dark" style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
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
                                     <th scope="col">Status</th>
                                     <th scope="col">Kab/kota</th>
                                     <th scope="col">KCD</th>
                                     <th scope="col">Opsi</th>
                                  </tr>
                               </thead>
                               <tbody>
                                @foreach ($data as $d)    
                                  <tr id="{{ $d->npsn }}">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td class="text-field">{{ $d->nama_sekolah }}</td>
                                    <td class="text-field">{{ $d->status }}</td>
                                    <td class="text-field">{{ $d->kab->nama_kab }}</td>
                                    <td class="text-field">{{ $d->kab->kcd->singkatan }}</td>
                                    <td>
                                      <button class="badge border-0 bg-warning text-dark" data-bs-toggle="modal" data-bs-target="#EditData">
                                        <i class="bx bx-edit-alt fs-6 mt-1" onclick="editSekolah('{{ $d->npsn }}')"></i>
                                      </button>
                                      <button class="badge border-0 bg-danger" onclick="deleteSekolah('{{ $d->npsn }}')">
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
                  <div class="modal-dialog modal-static">
                      <div class="modal-content">
                          <div class="modal-header bg-secondary-light">
                              <h3 class="modal-title">Tambah Data</h3>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <form class="row g-3" action="/disdik/sekolah/store" method="POST">
                                  @csrf
                                  <div class="col-12"> 
                                      <label for="inputNpsn" class="form-label">NPSN Sekolah</label> 
                                      <input type="text" class="form-control @error('npsn')
                                          is-invalid
                                      @enderror" id="inputNpsn" name="npsn" value="{{ old('npsn') }}">
                                      @error('npsn')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12"> 
                                      <label for="inputNamaSekolah" class="form-label">Nama Sekolah</label> 
                                      <input type="text" class="form-control @error('nama_sekolah')
                                          is-invalid
                                      @enderror" id="inputNamaSekolah" name="nama_sekolah" value="{{ old('nama_sekolah') }}">
                                      @error('nama_sekolah')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12"> 
                                      <label class="form-label">Status</label>
                                      <select class="form-select @error('status')
                                          is-invalid
                                      @enderror" name="status">
                                        <option selected disabled>Pilih Status</option>
                                        <option value="negeri">Negeri</option>
                                        <option value="swasta">Swasta</option>
                                      </select>
                                      @error('status')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12">
                                    <label class="form-label">Kab/Kota</label>
                                    <select id="mySelect1" style="width: 100%;" name="id_kab">
                                      <option selected disabled>Pilih Kabupaten</option>
                                      @foreach ($kab as $k)
                                          <option value="{{ $k->id }}">{{ $k->nama_kab }}</option>
                                      @endforeach
                                    </select>
                                    @error('id_kab')
                                    <div style="font-size: 14px;" class="text-danger">
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
          <!-- form edit -->
              <div class="modal fade" id="EditData" tabindex="-1">
                  <div class="modal-dialog modal-static">
                      <div class="modal-content">
                          <div class="modal-header bg-secondary-light">
                              <h3 class="modal-title">Ubah Data</h3>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form class="row g-3" action="/disdik/sekolah/update" method="POST">
                              @csrf
                              <div class="col-12"> 
                                  <label for="inputEditNpsn" class="form-label">NPSN Sekolah</label> 
                                  <input type="text" class="form-control" id="inputEditNpsn" name="npsn" readonly>
                              </div>
                              <div class="col-12"> 
                                  <label for="inputEditNamaSekolah" class="form-label">Nama Sekolah</label> 
                                  <input type="text" class="form-control @error('nama_sekolah')
                                      is-invalid
                                  @enderror" id="inputEditNamaSekolah" name="nama_sekolah">
                                  @error('nama_sekolah')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12"> 
                                  <label class="form-label">Status</label>
                                  <select class="form-select" name="status">
                                    <option selected disabled>Pilih Status</option>
                                    <option value="negeri">Negeri</option>
                                    <option value="swasta">Swasta</option>
                                  </select>
                              </div>
                              <div class="col-12">
                                <label for="" class="form-label">Kab/Kota</label>
                                <select id="EditmySelect1" style="width: 100%;" name="id_kab">
                                  <option selected disabled>Pilih Kabupaten</option>
                                  @foreach ($kab as $k)
                                      <option value="{{ $k->id }}">{{ $k->nama_kab }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-1"></i>Kembali</button> 
                                  <button type="submit" class="btn btn-outline-dark me-1"><i class="bi bi-person-check-fill"></i> Ubah Data</button>
                              </div>
                          </form>
                          </div>
                      </div>
                  </div>
              </div>
          <!-- endForm edit -->
          <!-- form update file -->
              <div class="modal fade" id="uploadFile" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                          <div class="modal-header border-0">
                              <h5 class="modal-title">Upload File</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body border-upload">
                               <form action="/disdik/import/sekolah" method="POST" enctype="multipart/form-data">
                                  @csrf
                                  <h4 class="text-center">Pilih file disini</h4>
                                  <p class="text-field text-center">Files Supported: xlsx, .xlsb, .xls , .xls</p>
                                  <input type="file" id="files" name="file_excel" multiple="multiple" class="border-bottom" />
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
          <!-- endform update file -->
          <!-- endForm Modal -->
      </div>
    </section>
  </main>
  <script>
    function editSekolah(id){
      $.ajax({
          url: `/disdik/getSekolah`,
          type: "GET",
          data: {id:id},
          cache: false,
          success:function(response){
            console.log(response);
              $('#inputEditNpsn').val(response[0].npsn);
              $('#inputEditNamaSekolah').val(response[0].nama_sekolah);
          },
          error:function(response){
            console.log('Error');
            console.log(response);
          }
      });
    }
    function deleteSekolah(id){
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
          console.log(id);
          $.ajax({
            type:'POST',
            url:'/disdik/sekolah/destroy',
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
    $(document).ready(function () {
      @if(count($errors) > 0)
        Swal.fire("Error", "Kelola data gagal!", "error");
      @endif
    });
  </script>
@endsection