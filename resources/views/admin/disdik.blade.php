@extends('layouts.admin')
@section('contents')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
        <li class="breadcrumb-item">Data Users</li>
        <li class="breadcrumb-item active">Admin Disdik</li>
      </ol>
    </nav>
  </div>
  <section class="section">
    
    <div class="row">
       <div class="col-lg-12">
          <div class="card">
             <div class="card-body">
              <div class="header-tabel">
                <div class="row title-table align-items-center">
                  <div class="col">
                    <h5 class="card-title users">Data Admin Disdik</h5>
                    <p>Semua data users Admin Disdik!</p>
                  </div>
                  <div class="col ~btn-tamimport d-flex gap-1 justify-content-end">
                    <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#TambahData"
                    style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
                      <i class="bi bi-person-plus-fill me-1 add-data"></i>
                       Tambah Akun
                    </button>
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#uploadFile"
                    style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
                      <i class="bi bi-box-arrow-in-down me-1"></i>
                       Import
                    </button>
                    <a href="/admin/export/disdik" class="btn btn-dark" style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
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
                         <th scope="col">Nama</th>
                         <th scope="col">Username</th>
                         <th scope="col">Level</th>
                         <th scope="col">Opsi</th>
                      </tr>
                   </thead>
                   <tbody>
                      @foreach ($data as $d)    
                      <tr id="{{ $d->id }}">
                         <th scope="row">{{ $loop->iteration }}</th>
                         <td class="fw-semibold">{{ $d->name }}</td>
                         <td class="text-field">{{ $d->username }}</td>
                         <td class="text-field">Disdik</td>
                         <td>
                          <a data-id="{{ $d->id }}" class="btn-edit badge border-0 bg-warning text-dark" data-bs-toggle="modal" data-bs-target="#EditData">
                            <i class="bx bx-edit-alt fs-6 mt-1"></i>
                          </a>
                          <button data-id="{{ $d->id }}" class="badge border-0 bg-danger btn-delete">
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
  </section>
</main>
    {{-- Form Tambah --}}
    <div class="modal fade" id="TambahData" tabindex="-1">
      <div class="modal-dialog modal-static">
        <div class="modal-content">
          <div class="modal-header bg-secondary-light">
            <h3 class="modal-title">Tambah Akun</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3" action="/admin/store" method="POST">
              @csrf
              <div class="col-12"> 
                <label for="inputNama" class="form-label">Nama</label> 
                <input type="text" class="form-control @error('name')
                    is-invalid
                @enderror" id="inputNama" name="name" value="{{ old('name') }}">
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-12"> 
                <label for="inputUsername" class="form-label">Username</label> 
                <input type="text" class="form-control @error('username')
                    is-invalid
                @enderror" id="inputUsername" name="username" value="{{ old('username') }}">
                @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-12"> 
                <label for="inputPassword" class="form-label">Password</label> 
                <input type="password" class="form-control @error('password')
                    is-invalid
                @enderror" id="inputPassword" name="password">
                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <input type="text" name="kode_user" value="disdik" hidden>
              <input type="text" name="level_id" value="2" hidden>
              <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-1"></i>Kembali</button> 
                <button type="submit" class="btn btn-outline-dark me-1"><i class="bi bi-person-check-fill"></i> Tambah Akun</button>
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
            <h3 class="modal-title">Ubah Akun</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="row g-3" id="formEdit" method="POST">
              @csrf
              @method('put')
              <div class="col-12"> 
                <label for="inputEditNama" class="form-label">Nama</label> 
                <input type="text" class="form-control @error('name')
                    is-invalid
                @enderror" id="inputEditNama" name="name">
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-12"> 
                <label for="inputEditUsername" class="form-label">Username</label> 
                <input type="text" class="form-control @error('username')
                    is-invalid
                @enderror" id="inputEditUsername" name="username">
                @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-12"> 
                <label for="inputEditPassword" class="form-label">Password</label> 
                <input type="password" class="form-control" id="inputEditPassword" name="password">
                <small class="form-text text-muted">*Password akan diganti apabila diisi | Kosongkan jika tidak ingin diganti</small>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i class="bi bi-arrow-left me-1"></i>Kembali</button> 
                <button type="submit" class="btn btn-outline-dark me-1"><i class="bi bi-person-check-fill"></i> Ubah Akun</button>
              </div>
           </form>
          </div>
        </div>
      </div>
    </div>

    {{-- Form Import --}}
    <div class="modal fade" id="uploadFile" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0">
            <h5 class="modal-title">Upload File</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body border-upload">
            <form action="/admin/import/disdik" method="POST" enctype="multipart/form-data">
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

    <script>
      $(document).ready(function () {
        @if(count($errors) > 0)
          Swal.fire("Error", "Kelola data gagal!", "error");
        @endif
        $('.btn-edit').on('click', function () {
          $('#formEdit').attr('action', '/admin/update/' + $(this).data('id'));
          let id = $(this).data('id');
          $.ajax({
              url: `/admin/getUser`,
              type: "GET",
              data: {id:id},
              cache: false,
              success:function(response){
                  $('#inputEditNama').val(response[0].name);
                  $('#inputEditUsername').val(response[0].username);
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
                  type:'delete',
                  url:'/admin/delete/'+id,
                  data:{
                      "_token": "{{ csrf_token() }}",
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