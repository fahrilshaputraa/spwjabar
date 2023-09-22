@extends('layouts.disdik')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Data Master</li>
          <li class="breadcrumb-item active">Data KCD</li>
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
                            <h5 class="card-title users">Data KCD</h5>
                            <p>Semua kcd yang ada di  Disdik Jabar!</p>
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
                            <a href="/disdik/export/kcd" class="btn btn-dark"
                            style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
                              <i class="bi bi-box-arrow-up me-1"></i>
                              Export
                            </a>
                          </div>
                        </div>
                      </div>
                        <table class="table datatable border">
                           <thead class="bg-secondary bg-opacity-10 border-0 text-secondary">
                              <tr>
                                 <th scope="col">No</th>
                                 <th scope="col">Nama</th>
                                 <th scope="col">Singkatan</th>
                                 <th scope="col">Opsi</th>
                              </tr>
                           </thead>
                           <tbody>
                            @foreach ($data as $d)
                            <tr id="{{ $d->id }}">
                               <th scope="row">{{ $loop->iteration }}</th>
                               <td class="text-field">{{ $d->nama_kcd }}</td>
                               <td class="text-field">{{ $d->singkatan }}</td>
                               <td>
                                <button data-id="{{ $d->id }}" class="btn-edit badge border-0 bg-warning text-dark" data-bs-toggle="modal" data-bs-target="#EditData">
                                  <i class="bx bx-edit-alt fs-6 mt-1"></i>
                                </button>
                                <button data-id="{{ $d->id }}" class="btn-delete badge border-0 bg-danger">
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
        {{-- From Tambah --}}
          <div class="modal fade" id="TambahData" tabindex="-1">
              <div class="modal-dialog modal-static">
                  <div class="modal-content">
                      <div class="modal-header bg-secondary-light">
                          <h3 class="modal-title">Tambah Data</h3>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form class="row g-3" action="/disdik/kcd/store" method="POST">
                            @csrf
                              <div class="col-12"> 
                                  <label for="inputNama" class="form-label">Nama</label> 
                                  <input type="text" class="form-control @error('nama_kcd')
                                      is-invalid
                                  @enderror" id="inputNama" name="nama_kcd" value="{{ old('nama_kcd') }}">
                                  @error('nama_kcd')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                              </div>
                              <div class="col-12"> 
                                  <label for="inputSingkatan" class="form-label">Singkatan</label>
                                  <input type="text" class="form-control @error('singkatan')
                                      is-invalid
                                  @enderror" id="inputSingkatan" name="singkatan" value="{{ old('singkatan') }}">
                                  @error('singkatan')
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
              <div class="modal-dialog modal-static">
                  <div class="modal-content">
                      <div class="modal-header bg-secondary-light">
                          <h3 class="modal-title">Ubah Data</h3>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                          <form class="row g-3" action="/disdik/kcd/update" method="POST">
                            @csrf
                              <div class="col-12"> 
                                  <label for="inputEditNama" class="form-label">Nama</label> 
                                  <input type="text" class="form-control @error('nama_kcd')
                                      is-invalid
                                  @enderror" id="inputEditNama" name="nama_kcd">
                                  @error('nama_kcd')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                  @enderror
                                </div>
                              <div class="col-12"> 
                                  <label for="inputEditSingkatan" class="form-label">Singkatan</label>
                                  <input type="text" class="form-control @error('singkatan')
                                      is-invalid
                                  @enderror" id="inputEditSingkatan" name="singkatan">
                                  @error('singkatan')
                                  <div class="invalid-feedback">
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
                           <form action="/disdik/import/kcd" method="POST" enctype="multipart/form-data">
                              @csrf
                              <h4 class="text-center">Pilih file disini</h4>
                              <p class="text-field text-center">Files Supported: .xls, .xlsx, .xlsb</p>
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
    $(document).ready(function () {
      @if(count($errors) > 0)
        Swal.fire("Error", "Kelola data gagal!", "error");
      @endif
      $('.btn-edit').on('click', function () {
        let id = $(this).data('id');
        $.ajax({
            url: `/disdik/getKcd`,
            type: "GET",
            data: {id:id},
            cache: false,
            success:function(response){
                $('#inputEditId').val(response[0].id);
                $('#inputEditNama').val(response[0].nama_kcd);
                $('#inputEditSingkatan').val(response[0].singkatan);
            }
        });
      });
      $('.btn-delete').on('click', function (e) {
          e.preventDefault();
          let id = $(this).data('id');
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
                url:'/disdik/kcd/destroy',
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
      });
    });
  </script>
@endsection