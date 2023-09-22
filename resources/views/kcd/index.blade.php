@extends('layouts.kcd')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/kcd">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-4">
              <div class="card info-card rounded-3 disdik-card">
                <div class="card-body">
                  <h5 class="card-title">Kabupaten / Kota</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bi bi-map"></i></div>
                    <div class="ps-3">
                      <h6>{{ $kab }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card info-card rounded-3 school-card">
                <div class="card-body">
                  <h5 class="card-title">Sekolah</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class='bx bxs-school'></i></div>
                    <div class="ps-3">
                      <h6>{{ $sekolah }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card info-card rounded-3 users-card">
                <div class="card-body">
                  <h5 class="card-title">Siswa / Siswi</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bi bi-people-fill"></i></div>
                    <div class="ps-3">
                      <h6>{{ $siswa }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                 <div class="card-body">
                    <h5 class="card-title mb-0">Top 10</h5>
                    <p class="text-muted">Dengan jumlah siswa terbanyak.</p>
                    <canvas id="barChart" style="max-height: 400px;"></canvas>
                    <script>document.addEventListener("DOMContentLoaded", () => {
                       new Chart(document.querySelector('#barChart'), {
                         type: 'bar',
                         data: {
                           labels: [{{ Js::from($data[0]->nama_sekolah) }}, {{ Js::from($data[1]->nama_sekolah) }}, {{ Js::from($data[2]->nama_sekolah) }}, {{ Js::from($data[3]->nama_sekolah) }}, {{ Js::from($data[4]->nama_sekolah) }}, {{ Js::from($data[5]->nama_sekolah) }}, {{ Js::from($data[6]->nama_sekolah) }}, {{ Js::from($data[7]->nama_sekolah) }}, {{ Js::from($data[8]->nama_sekolah) }}, {{ Js::from($data[9]->nama_sekolah) }}, ],
                           datasets: [{
                             label: 'Bar Chart',
                             data: [{{ Js::from($data[0]->jml_wirausaha) }}, {{ Js::from($data[1]->jml_wirausaha) }}, {{ Js::from($data[2]->jml_wirausaha) }}, {{ Js::from($data[3]->jml_wirausaha) }}, {{ Js::from($data[4]->jml_wirausaha) }}, {{ Js::from($data[5]->jml_wirausaha) }}, {{ Js::from($data[6]->jml_wirausaha) }}, {{ Js::from($data[7]->jml_wirausaha) }}, {{ Js::from($data[8]->jml_wirausaha) }}, {{ Js::from($data[9]->jml_wirausaha) }}],
                             backgroundColor: [
                               'rgba(255, 99, 132, 0.2)',
                               'rgba(255, 159, 64, 0.2)',
                               'rgba(255, 205, 86, 0.2)',
                               'rgba(75, 192, 192, 0.2)',
                               'rgba(54, 162, 235, 0.2)',
                               'rgba(153, 102, 255, 0.2)',
                               'rgba(201, 203, 207, 0.2)'
                             ],
                             borderColor: [
                               'rgb(255, 99, 132)',
                               'rgb(255, 159, 64)',
                               'rgb(255, 205, 86)',
                               'rgb(75, 192, 192)',
                               'rgb(54, 162, 235)',
                               'rgb(153, 102, 255)',
                               'rgb(201, 203, 207)'
                             ],
                             borderWidth: 1
                           }]
                         },
                         options: {
                           scales: {
                             y: {
                               beginAtZero: true
                             }
                           }
                         }
                       });
                       });
                    </script> 
                 </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Top 10 <span>| Dengan banyak nya Siswa</span></h5>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Sekolah</th>
                        <th scope="col">Kabupaten/Kota</th>
                        <th scope="col">Banyak Siswa</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row"><a href="#">1.</a></th>
                        <td>{{ $data[0]->nama_sekolah }}</td>
                        <td>{{ $data[0]->kab->nama_kab }}</td>
                        <td>{{ $data[0]->jml_wirausaha }}</td>
                        <td class="text-center fs-5">🥇</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">2.</a></th>
                        <td>{{ $data[1]->nama_sekolah }}</td>
                        <td>{{ $data[1]->kab->nama_kab }}</td>
                        <td>{{ $data[1]->jml_wirausaha }}</td>
                        <td class="text-center fs-5">🥈</td>
                      </tr>
                      <tr>
                        <th scope="row"><a href="#">3.</a></th>
                        <td>{{ $data[2]->nama_sekolah }}</td>
                        <td>{{ $data[2]->kab->nama_kab }}</td>
                        <td>{{ $data[2]->jml_wirausaha }}</td>
                        <td class="text-center fs-5">🥉</td>
                      </tr>
                      @php
                          $i = 4
                      @endphp
                      @foreach ($data->skip(3) as $d)
                        <tr>
                          <th scope="row">{{ $i++ }}</th>
                          <td>{{ $d->nama_sekolah }}</td>
                          <td>{{ $d->kab->nama_kab }}</td>
                          <td>{{ $d->jml_wirausaha }}</td>
                          <td class="text-center"></td>
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
@endsection