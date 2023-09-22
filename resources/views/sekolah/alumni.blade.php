@extends('layouts.sekolah')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/sekolah">Home</a></li>
          <li class="breadcrumb-item active">Pendataan Alumni</li>
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
                                <a href="/sekolah/alumni.insert" class="btn btn-outline-dark"
                                style="--bs-btn-padding-y: .35rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .78rem;">
                                  <i class="bi bi-person-plus-fill me-1 add-data"></i>
                                   Tambah Data
                                </a>
                                <a href="/sekolah/export/alumni" class="btn btn-dark"
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
                                        <a href="/sekolah/alumni.update.{{ $d->id_rekap }}" class="badge border-0 bg-warning text-dark" >
                                          <i class="bx bx-edit-alt fs-6 mt-1"></i>
                                        </a>
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
          url: `/sekolah/getAlumni`,
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
            url:'/sekolah/alumni/destroy',
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