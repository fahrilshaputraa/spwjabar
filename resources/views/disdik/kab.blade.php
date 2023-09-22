@extends('layouts.disdik')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active">Data Kab/Kota</li>
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
                                <h5 class="card-title users">Data Kab/Kota</h5>
                                <p>Semua kota/kab yang ada di  Disdik Jabar!</p>
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
                                <a href="/disdik/export/kab" class="btn btn-dark" style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
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
                                     <th scope="col">Nama kab/kota</th>
                                     <th scope="col">KCD</th>
                                     <th scope="col">Opsi</th>
                                  </tr>
                               </thead>
                               <tbody>
                                @foreach ($data as $d)    
                                <tr id="{{ $d->id }}">
                                   <th scope="row">{{ $loop->iteration }}</th>
                                   <td class="text-field">{{ $d->nama_kab }}</td>
                                   <td class="text-field">{{ $d->kcd->nama_kcd }}</td>
                                   <td>
                                    <button class="btn-edit badge border-0 bg-warning text-dark" data-bs-toggle="modal" data-bs-target="#EditData" onclick="editKab({{ $d->id }})">
                                      <i class="bx bx-edit-alt fs-6 mt-1"></i>
                                    </button>
                                    <button class="btn-delete badge border-0 bg-danger" onclick="deleteKab({{ $d->id }})">
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
                              <form class="row g-3" action="/disdik/kab/store" method="POST">
                                @csrf
                                  <div class="col-12"> 
                                      <label for="inputNama" class="form-label">Nama Kabupaten</label> 
                                      <input type="text" class="form-control @error('nama_kab')
                                          is-invalid
                                      @enderror" id="inputNama" name="nama_kab" value="{{ old('nama_kab') }}">
                                      @error('nama_kab')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12"> 
                                      <label for="mySelect2" class="form-label">KCD Wilayah</label>
                                      <select id="mySelect2" class="form-control" style=" width: 100%;" name="id_kcd">
                                        <option selected disabled>Pilih KCD</option>
                                        @foreach ($kcd as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama_kcd }}</option>
                                        @endforeach
                                      </select>
                                      @error('id_kcd')
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
                              <form class="row g-3" action="/disdik/kab/update" method="POST">
                                @csrf
                                  <div class="col-12"> 
                                      <label for="inputNama" class="form-label">Nama Kabupaten</label> 
                                      <input type="text" class="form-control @error('nama_kab')
                                          is-invalid
                                      @enderror" id="inputEditNama" name="nama_kab">
                                      @error('nama_kab')
                                      <div class="invalid-feedback">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="col-12"> 
                                      <label for="EditmySelect2" class="form-label">KCD Wilayah</label>
                                      <select id="EditmySelect2" class="form-control" style=" width: 100%;" name="id_kcd">
                                        <option selected disabled>Pilih KCD</option>
                                        @foreach ($kcd as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama_kcd }}</option>
                                        @endforeach
                                      </select>
                                      @error('id_kcd')
                                      <div style="font-size: 14px;" class="text-danger">
                                        {{ $message }}
                                      </div>
                                      @enderror
                                  </div>
                                  <input type="text" name="id" id="inputEditId" hidden>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-1"></i>Kembali</button> 
                                      <button type="submit" class="btn btn-outline-dark me-1"><i class="bi bi-person-check-fill"></i> Edit Data</button>
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
                               <form action="/disdik/import/kab" method="POST" enctype="multipart/form-data">
                                @csrf
                                  <h4 class="text-center">Pilih file disini</h4>
                                  <p class="text-field text-center">Files Supported: .xls, .xlsx</p>
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
    function editKab(id){
      console.log(id);
      $.ajax({
          url: `/disdik/getKab`,
          type: "GET",
          data: {id:id},
          cache: false,
          success:function(response){
              $('#inputEditId').val(response[0].id);
              $('#inputEditNama').val(response[0].nama_kab);
          }
      });
    }
    function deleteKab(id){
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
            url:'/disdik/kab/destroy',
            data:{
                "_token": "{{ csrf_token() }}",
                id:id
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
    $(document).ready(function () {
      @if(count($errors) > 0)
        Swal.fire("Error", "Kelola data gagal!", "error");
      @endif
    });
  </script>
@endsection