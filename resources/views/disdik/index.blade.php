@extends('layouts.disdik')
@section('contents')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>
  <section class="section dashboard">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-xxl-3 col-xl-12">
            <div class="card info-card rounded-3 kcd-card">
              <div class="card-body">
                <h5 class="card-title">KCD</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bx bxs-city"></i></div>
                  <div class="ps-3">
                    <h6>{{ $kcd }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card rounded-3 disdik-card">
              <div class="card-body">
                <h5 class="card-title">Kab/Kota</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bx bx-map-alt"></i></div>
                  <div class="ps-3">
                    <h6>{{ $kab }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card rounded-3 users-card">
              <div class="card-body">
                <h5 class="card-title"> Sekolah</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bx bxs-school"></i></div>
                  <div class="ps-3">
                    <h6>{{ $sekolah }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card rounded-3 siswa-card">
              <div class="card-body">
                <h5 class="card-title">Siswa / Siswi</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bx bx-group"></i></div>
                  <div class="ps-3">
                    <h6>{{ $siswa }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-3 col-md-6">
            <div class="card info-card rounded-3 school-card">
              <div class="card-body">
                <h5 class="card-title">Siswa/Siswi Alumni</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bi bi-people"></i></div>
                  <div class="ps-3">
                    <h6>{{ $alumni }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Data siswa SPW</h5>
                  <canvas id="barChart" style="max-height: 400px;"></canvas>
                  <script>document.addEventListener("DOMContentLoaded", () => {
                     new Chart(document.querySelector('#barChart'), {
                       type: 'bar',
                       data: {
                         labels: ['KCD I', 'KCD II', 'KCD III', 'KCD IV', 'KCD V', 'KCD VI', 'KCD VII', 'KCD VIII', 'KCD IX', 'KCD X', 'KCD XI', 'KCD XII', 'KCD XIII'],
                         datasets: [{
                           label: 'Bar Chart',
                           data: [{{ Js::from($kcdi) }}, {{ Js::from($kcdii) }}, {{ Js::from($kcdiii) }}, {{ Js::from($kcdiv) }}, {{ Js::from($kcdv) }}, {{ Js::from($kcdvi) }}, {{ Js::from($kcdvii) }}, {{ Js::from($kcdviii) }}, {{ Js::from($kcdix) }}, {{ Js::from($kcdx) }}, {{ Js::from($kcdxi) }}, {{ Js::from($kcdxii) }}, {{ Js::from($kcdxiii) }} ],
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
                <h5 class="card-title">Banyak Siswa <span>/ KCD</span></h5>
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Instansi</th>
                      <th scope="col">Banyak siswa</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row"><a href="#">1.</a></th>
                      <td>KCD I</td>
                      <td>{{ $kcdi }} siswa</td>
                    </tr>
                    <tr>
                      <th scope="row"><a href="#">2.</a></th>
                      <td>KCD II</td>
                      <td>{{ $kcdii }} siswa</td>
                    </tr>
                    <tr>
                      <th scope="row"><a href="#">3.</a></th>
                      <td>KCD III</td>
                      <td>{{ $kcdiii }} siswa</td>
                    </tr> 
                    <tr>
                      <th scope="row"><a href="#">4.</a></th>
                      <td>KCD IV</td>
                      <td>{{ $kcdiv }} siswa</td>
                    </tr> 
                    <tr>
                      <th scope="row"><a href="#">5.</a></th>
                      <td>KCD V</td>
                      <td>{{ $kcdv }} siswa</td>
                    </tr> 
                    <tr>
                      <th scope="row"><a href="#">6.</a></th>
                      <td>KCD VI</td>
                      <td>{{ $kcdvi }} siswa</td>
                    </tr> 
                    <tr>
                      <th scope="row"><a href="#">7.</a></th>
                      <td>KCD VII</td>
                      <td>{{ $kcdvii }} siswa</td>
                    </tr> 
                    <tr>
                      <th scope="row"><a href="#">8.</a></th>
                      <td>KCD VIII</td>
                      <td>{{ $kcdviii }} siswa</td>
                    </tr> 
                    <tr>
                      <th scope="row"><a href="#">9.</a></th>
                      <td>KCD IX</td>
                      <td>{{ $kcdix }} siswa</td>
                    </tr> 
                    <tr>
                      <th scope="row"><a href="#">10.</a></th>
                      <td>KCD X</td>
                      <td>{{ $kcdx }} siswa</td>
                    </tr> 
                    <tr>
                      <th scope="row"><a href="#">11.</a></th>
                      <td>KCD XI</td>
                      <td>{{ $kcdxi }} siswa</td>
                    </tr> 
                    <tr>
                      <th scope="row"><a href="#">12.</a></th>
                      <td>KCD XII</td>
                      <td>{{ $kcdxii }} siswa</td>
                    </tr> 
                    <tr>
                      <th scope="row"><a href="#">13.</a></th>
                      <td>KCD XIII</td>
                      <td>{{ $kcdxiii }} siswa</td>
                    </tr> 
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