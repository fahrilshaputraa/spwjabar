@extends('layouts.admin')
@section('contents')
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/admin">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card rounded-3 users-card">
                <div class="card-body">
                  <h5 class="card-title">Users <span>| Hari ini</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bi bi-people"></i></div>
                    <div class="ps-3">
                      <h6>{{ $data->count() }}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ $data->count() }}</span> <span class="text-muted small pt-2 ps-1">active</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card rounded-3 disdik-card">
                <div class="card-body">
                  <h5 class="card-title">Admin <span>| Disdik</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bi bi-bank"></i></div>
                    <div class="ps-3">
                      <h6>{{ $disdik }}</h6>
                      <span class="text-warning small pt-1 fw-bold">{{ $disdik }}</span> <span class="text-muted small pt-2 ps-1">active</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card rounded-3 kcd-card">
                <div class="card-body">
                  <h5 class="card-title">Admin <span>| KCD</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bx bxs-business"></i></div>
                    <div class="ps-3">
                      <h6>{{ $kcd }}</h6>
                      <span class="text-primary small pt-1 fw-bold">{{ $kcd }}</span> <span class="text-muted small pt-2 ps-1">active</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card rounded-3 school-card">
                <div class="card-body">
                  <h5 class="card-title">Admin <span>| Sekolah</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class="bx bxs-school"></i></div>
                    <div class="ps-3">
                      <h6>{{ $sekolah }}</h6>
                      <span class="text-danger small pt-1 fw-bold">{{ $sekolah }}</span> <span class="text-muted small pt-2 ps-1">active</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-12">
              <div class="row">
                <div class="col-md-8">
                  <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                      <h5 class="card-title">Users Active <span>| Hari Ini</span></h5>
                      <table class="table table-borderless datatable">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Instansi</th>
                            <th scope="col">Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Jam</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($data as $d)    
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $d->name }}</td>
                            <td>
                              @if ($d->level_id == '1')
                                {{ "Admin" }}
                              @elseif ($d->level_id == '2')
                                {{ "Disdik" }}
                              @elseif ($d->level_id == '3')
                                {{ $d->kcd->singkatan }}
                              @elseif ($d->level_id == '4')
                                {{ $d->sekolah->nama_sekolah }}
                              @endif
                            </td>
                            <td>{{ Carbon\Carbon::parse($d->last_seen)->diffForHumans() }}</td>
                            <td>
                              @if(Cache::has('user-is-online-' . $d->id))
                                <span class="badge bg-success online">Online</span>
                              @else
                                <span class="badge bg-danger offline">Offline</span>
                              @endif
                              <td>{{ now()}}</td>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users Active</h5>
                        <canvas id="pieChart" style="max-height: 400px;"></canvas>
                        <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          new Chart(document.querySelector('#pieChart'), {
                            type: 'pie',
                            data: {
                              labels: [
                                'Sekolah',
                                'KCD',
                                'Disdik'
                              ],
                              datasets: [{
                                label: 'My First Dataset',
                                data: [{{ Js::from($sekolah) }}, {{ Js::from($kcd) }}, {{ Js::from($disdik) }}],
                                backgroundColor: [
                                  'rgb(255, 99, 132)',
                                  'rgb(54, 162, 235)',
                                  'rgb(255, 205, 86)'
                                ],
                                hoverOffset: 4
                              }]
                            }
                          });
                        });
                        </script> 
                    </div>
                  </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection