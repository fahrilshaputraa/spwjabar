@extends('layouts.kcd')
@section('contents')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Kabupaten</li>
            </ol>
        </nav>
    </div>
    <section class="section">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-tabel">
                            <div class="row align-items-center">
                                <div class="col-lg-9 col-md-7 ">
                                    <h5 class="card-title users">Data Kabupaten atau Kota</h5>
                                    <p>Semua data Kabupaten / Kota yang ada di KCD?</p>
                                </div>
                            </div>
                        </div>
                        <!-- <hr class="dropdown-header mb-3"> -->
                        <table class="table-responsive-sm datatable border">
                            <thead class="bg-secondary bg-opacity-10 border-0">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kabupaten / Kota</th>
                                    <th scope="col">Asal KCD</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <th scope="row" class="text-field">{{ $loop->iteration }}</th>
                                    <td class="text-field">{{ $d->nama_kab }}</td>
                                    <td class="text-field">{{ $d->kcd->singkatan }}</td>
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
@endsection