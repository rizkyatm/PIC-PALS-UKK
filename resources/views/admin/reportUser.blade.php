@extends('admin.layoutMaster.master')

@section('title', 'Report Foto - Admin Pic Pals')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Report postingan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Report postingan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                        Table Report postingan
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Username</th>
                                <th>Judul Foto</th>
                                <th>Laporan</th>
                                <th>Jenis Laporan</th>
                                <th>Detail foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($report->fotos)
                                            <img style="max-width: 50px" src="{{ asset('storage/'.$report->fotos->lokasi_file) }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        @if($report->fotos && $report->fotos->user)
                                            {{$report->fotos->user->username}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($report->fotos)
                                            {{$report->fotos->judul_foto}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($report->pelapors)
                                            {{$report->pelapors->username}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($report->jenisLaporans)
                                            {{$report->jenisLaporans->jenis_laporan}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($report->fotos)
                                            <a data-bs-toggle="modal" data-bs-target="#detailmodal{{$report->fotos->id}}" href=""><span class="badge bg-warning">Detail</span></a>
                                        @endif
                                    </td>
                                    <td style="width: 250px">
                                        <form action="{{ route('laporan.valid', $report->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button style="width: 165px" type="submit" class="mb-1 btn btn-success">Laporan  Valid</button>
                                        </form>
                                        <form action="{{ route('laporan.tidak.valid', $report->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <button style="300px" type="submit" class="btn btn-danger">Laporan tidak Valid</button>
                                        </form>         
                                    </td>
                                </tr>

                                <div class="modal fade" id="detailmodal{{ optional($report->fotos)->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Detail Postingan</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if($report->fotos)
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <img style="max-width: 300px; align-items: center" src="{{ asset('storage/'. optional($report->fotos)->lokasi_file) }}" alt="">
                                                    </div>
                                                    <h1 class="text-center mt-2">
                                                        {{ optional($report->fotos)->judul_foto }}
                                                    </h1>
                                                    <p>
                                                        {{ optional($report->fotos)->deskripsi_foto }}
                                                    </p>
                                                @endif
                                            </div>  
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach
                            {{-- <tr>
                                <td>1</td>
                                <td>vehicula.aliquet@semconsequat.co.uk</td>
                                <td>19-02-2025</td>
                                <td>19-02-2025</td>
                                <td>
                                    <a href=""><span class="badge bg-danger">Delete</span></a>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>


    
    
@endsection