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
                    <table class="table datatable ">
                        <thead>
                          <tr>
                            <th>
                              <b>No</b>
                            </th>
                            <th style="width: 130px;">
                              Postingan
                            </th>
                            <th>Pemosting</th>
                            <th style="width: 150px;">Deskripsi</th>
                            <th>Jumlah Laporan</th>
                            <th>Status</th>
                            <th data-type="date" data-format="MM/DD/YYYY" style="width: 120px;">Tanggal</th>
                            <th style="width: 10px;">Aksi</th>
                        </thead>
                        <tbody>
                          @php $number = 1 @endphp
                          @foreach($groupedReports as $foto_id => $reports)
                          <tr>
                            <td>{{ $number++ }}</td>
                            <td>
                              <img src="{{ asset('storage/'.$reports->first()->fotos->lokasi_file) }}" alt="{{ $reports->first()->fotos->judul_foto }}" style="width: 80px;">
                            </td>
                            <td>{{ $reports->first()->fotos->user->username }}</td>
                            <td>{{ $reports->first()->fotos->deskripsi_foto }}</td>
                            <td>
                                 <div>Terdapat {{ count($reports->pluck('jenisLaporans')->unique()) }} Laporan</div>
                            </td>
                            <td>
                                <ul class="p-1 m-0" style="list-style-type: none;">
                                    @if($reports->isNotEmpty())
                                        <li>
                                            <div class="badge text-bg-danger">{{ $reports->first()->status }}</div>
                                        </li>
                                    @endif
                                </ul>                                
                            </td>
                            <td>
                              {{-- @foreach($reports as $report) --}}
                              <div>{{ $reports->first()->fotos->created_at->format('d/m/Y') }}</div>
                              {{-- @endforeach --}}
                            </td>
                            <td>
                                <div style="display: flex; ">

                                    <button class="btn btn-warning-1"  data-bs-toggle="modal"  data-bs-target="#modalDetail{{ $reports->first()->fotos->user->id }}"><i class="bi bi-eye"></i></button> 
                                      @if(count($reports->pluck('jenisLaporans')->unique()) > 0)
                                      <form action="{{ route('hapus.foto.report', ['id' => $reports->first()->fotos->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger-1"><i class="bi bi-trash"></i></button>
                                        </form>
                                      @endif
                                </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                    @if($reports->isNotEmpty())
                    <div class="modal fade" id="modalDetail{{ $reports->first()->fotos->user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Detail Laporan
                                    </h5>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Pelapor</th>
                                                <th>Jenis Laporan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reports as $report)
                                            <tr>
                                                <td>{{ $report->pelapors->username }}</td>
                                                <td>{{ $report->jenisLaporans->jenis_laporan }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                                      
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary"
                                        data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </section>
    </div>
@endsection