@extends('layouts.sekolah')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-6">
              <div class="card info-card rounded-3 siswa-card">
                <div class="card-body">
                  <h5 class="card-title">Siswa / Siswi</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bi bi-people"></i></div>
                    <div class="ps-3">
                      <h6>{{ $jml_siswa }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card info-card rounded-3 school-card">
                <div class="card-body">
                  <h5 class="card-title">Siswa/Siswi Alumni</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bi bi-people"></i></div>
                    <div class="ps-3">
                      <h6>{{ $jml_alumni }}</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                 <div class="card-body">
                    <h5 class="card-title mb-0">Top 10</h5>
                    <p class="text-muted">Siswa dengan omset terbesar.</p>
                    <canvas id="barChart" style="max-height: 400px;"></canvas>
                    <script>
                    document.addEventListener("DOMContentLoaded", () => {
                       new Chart(document.querySelector('#barChart'), {
                         type: 'bar',
                         data: {
                           labels: {!! json_encode($label_chart, JSON_NUMERIC_CHECK) !!},
                           datasets: [{
                             label: 'Bar Chart',
                             data: {!! json_encode($data_chart, JSON_NUMERIC_CHECK) !!},
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
                  <h5 class="card-title">Top 10 <span>| Siswa dengan omset terbanyak</span></h5>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama siswa</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Banyak Omset siswa</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (count($data) == 1  || count($data) > 1)    
                      <tr>
                        <th scope="row">1.</th>
                        <td>{{ $data[0]->nama_lengkap }}</td>
                        <td>{{ $data[0]->kelas }}</td>
                        <td>{{ $data[0]->omset }}</td>
                        <td class="text-center fs-5">🥇</td>
                      </tr>
                      @endif
                      
                      @if(count($data) == 2 || count($data) > 2)
                      <tr>
                        <th scope="row">2.</th>
                        <td>{{ $data[1]->nama_lengkap }}</td>
                        <td>{{ $data[1]->kelas }}</td>
                        <td>{{ $data[1]->omset }}</td>
                        <td class="text-center fs-5">🥈</td>
                      </tr>
                      @endif
                      @if(count($data) == 3 || count($data) > 3)
                      <tr>
                        <th scope="row">3.</th>
                        <td>{{ $data[2]->nama_lengkap }}</td>
                        <td>{{ $data[2]->kelas }}</td>
                        <td>{{ $data[2]->omset }}</td>
                        <td class="text-center fs-5">🥉</td>
                      </tr>
                      @endif
                      @php
                          $i = 4
                      @endphp
                      @foreach ($data->skip(3) as $d)
                      <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $d->nama_lengkap }}</td>
                        <td>{{ $d->kelas }}</td>
                        <td>@currency($d->omset)</td>
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