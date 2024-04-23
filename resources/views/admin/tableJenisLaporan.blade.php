@extends('admin.layoutMaster.master')

@section('title', 'Dashboard - Admin Pic Pals')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    {{-- <div class="page-heading">
        <h3>Jenis Laporan</h3>
    </div> --}}
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data jenis Laporan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">
                        Table jenis Laporan
                    </h5>
                    <a class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#add-jenisLaporan"><i data-feather="plus-circle"></i>Tambah Data</a>
                    <!--BorderLess Modal Modal -->
                    <div class="modal fade text-left modal-borderless" id="add-jenisLaporan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">TAMBAH DATA JENIS LAPORAN</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="card-body pt-0">
                                    <form id="form-laporan" action="{{ route("tambah.jenisLaporan") }}" class="form form-vertical">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">jenis laporan</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" name="jenis_laporan" placeholder="Ketik jenis laporan" id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-alphabet"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="button" class="btn btn-primary me-1 mb-1" onclick="submitForm()">Submit</button>
                                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Laporan</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td>1</td>
                                <td>vehicula.aliquet@semconsequat.co.uk</td>
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function deleteItem(id) {
            // Dapatkan token CSRF dari meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Lakukan permintaan AJAX untuk menghapus data
            $.ajax({
                type: 'POST',
                url: '/delete-jenis-laporan',
                data: {
                    id: id,
                    _token: csrfToken  // Sertakan token CSRF di sini
                },
                success: function(response) {
                    toastr.success('Data jenis laporan berhasil dihapus', 'Success', { 
                        "progressBar": true, 
                        "positionClass": "toast-top-right", 
                        "showDuration": "300", 
                        "hideDuration": "1000", 
                        "timeOut": "1500", 
                        "extendedTimeOut": "1000", 
                        "showEasing": "swing", 
                        "hideEasing": "linear", 
                        "showMethod": "fadeIn", 
                        "hideMethod": "fadeOut", 
                        "closeButton": true, 
                        "toastClass": "toast-green-solid", 
                    });
                    $('#jenis-laporan-' + id).remove();
                    console.log(response.message);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function submitForm() {
            // Mengambil data form
            var jenisLaporan = $('input[name="jenis_laporan"]').val();
    
            // Kirim data ke server
            $.ajax({
                type: 'POST',
                url: $('#form-laporan').attr('action'), // Menggunakan URL dari atribut action form
                data: {
                    '_token': '{{ csrf_token() }}',
                    'jenis_laporan': jenisLaporan,
                    'is_enable': 1
                },
                success: function(response) {
                    toastr.success('Data jenis laporan berhasil ditambah', 'Success', { 
                        "progressBar": true, 
                        "positionClass": "toast-top-right", 
                        "showDuration": "300", 
                        "hideDuration": "1000", 
                        "timeOut": "1500", 
                        "extendedTimeOut": "1000", 
                        "showEasing": "swing", 
                        "hideEasing": "linear", 
                        "showMethod": "fadeIn", 
                        "hideMethod": "fadeOut", 
                        "closeButton": true, 
                        "toastClass": "toast-green-solid", 
                        "onHidden": function(){
                            $('#add-jenisLaporan').modal('hide');
                            $('input[name="jenis_laporan"]').val('');
                            updateJenisLaporan();
                            dataTable.destroy();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    // Handle error di sini
                    console.error(xhr.responseText);
                    toastr.error('Data jenis laporan gagal ditambahkan', 'Error', { 
                        "progressBar": true, 
                        "positionClass": "toast-top-right", 
                        "showDuration": "300", 
                        "hideDuration": "1000", 
                        "timeOut": "1500", 
                        "extendedTimeOut": "1000", 
                        "showEasing": "swing", 
                        "hideEasing": "linear", 
                        "showMethod": "fadeIn", 
                        "hideMethod": "fadeOut", 
                        "closeButton": true, 
                        "toastClass": "toast-red-solid", 
                    });
                }
            });
        }

        function updateJenisLaporan() {  
            // Lakukan request AJAX untuk memperbarui data jenis laporan
            $.ajax({
                type: 'GET',
                url: '{{ route("load.jenisLaporan") }}', // Ganti dengan URL yang sesuai
                success: function(response) {
                    // Bersihkan tabel sebelum menambahkan data baru
                    $('#table1 tbody').empty();


                    // Iterasi melalui data dan tambahkan ke dalam tabel
                    $.each(response.data, function(index, item) {
                        var createAtFormat = moment(item.created_at).format('D MMMM YYYY');x
                            $('#table1 tbody').append(
                                '<tr id="jenis-laporan-' + item.id + '">' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + item.jenis_laporan + '</td>' +
                                    '<td>' + createAtFormat +  '</td>' +
                                    '<td>' +
                                        '<a href="#" onclick="deleteItem(' + item.id + ')"><span class="badge bg-danger">Delete</span></a>' +
                                    '</td>' +
                                '</tr>'
                            );
                        });
                    
                        if (dataTable) {
                            dataTable = new simpleDatatables.DataTable(
                                document.getElementById("table1")
                            );
                        }

                     
                },
                error: function(xhr, status, error) {
                    // Handle error di sini
                    console.error(xhr.responseText);
                }
            });
        }

        $(document).ready(function() {
            // Panggil fungsi untuk memuat jenis laporan saat halaman dimuat
            loadJenisLaporan();

            // Fungsi untuk memuat jenis laporan
            function loadJenisLaporan() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route("load.jenisLaporan") }}',
                    success: function(response) {
                        // Bersihkan tabel sebelum menambahkan data baru
                        $('#table1 tbody').empty();

                        // Iterasi melalui data dan tambahkan ke dalam tabel
                        $.each(response.data, function(index, item) {
                            var createAtFormat = moment(item.created_at).format('D MMMM YYYY');
                            if (!$('#jenis-laporan-' + item.id).length) {
                                $('#table1 tbody').append(
                                    '<tr id="jenis-laporan-' + item.id + '">' +
                                        '<td>' + (index + 1) + '</td>' +
                                        '<td>' + item.jenis_laporan + '</td>' +
                                        '<td>' + createAtFormat + '</td>' +
                                        '<td>' +
                                            '<a href="#" onclick="deleteItem(' + item.id + ')"><span class="badge bg-danger">Delete</span></a>' +
                                        '</td>' +
                                    '</tr>'
                                );
                            }
                        });

                        // Buat kembali objek dataTable
                        dataTable = new simpleDatatables.DataTable(
                            document.getElementById("table1")
                        );
                    },
                    error: function(xhr, status, error) {
                        // Handle error di sini
                        console.error(xhr.responseText);
                    }
                });
            }
        });

    </script>
    
    
@endsection