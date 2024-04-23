@extends('user.layoutMaster.master')

@section('title', 'Album - Pic Pals')

@section('style')
    <style>
        .head{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        @media (max-width: 950px) {
            .head{
                display: block;
            }
            .text-css{
                font-size: 30px;
            }
        }
        #style-2::-webkit-scrollbar-track
        {   
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }

        #style-2::-webkit-scrollbar
        {   
            display: none;
            width: 5px;
            background-color: #F5F5F5;
        }

        #style-2::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #132B40;
        }
        .gambar-utama:hover {
            opacity: 0.8;
        }
        #modalImage {
            width: 40vw;

        }
        #dialog_modal {
            max-width: 80%;
            min-height: 90vh
        }

        .container-detail-post{
            display: flex;
        }
        .card-body-d{
            width: 50%;
        }
        @media (max-width: 800px) {
            .container-detail-post{
                display: block;
            }
            .card-body-d{
                width: 100%;
            }
            #modalImage {
                width: 100%
            }
        }
        @media (max-width: 575px) {
            #dialog_modal{
                max-width: 100%;
            }
        }

        .comment-wrapper .panel-body {
            max-height:650px;
            overflow:auto;
        }

        .comment-wrapper .media-list .media img {
            width:64px;
            height:64px;
            border:2px solid #e5e7e8;
        }

        .comment-wrapper .media-list .media {
            border-bottom:1px dashed #efefef;
            margin-bottom:25px;
        }
        
        /* line 256, node_modules/bootstrap/scss/_card.scss */
        .card-columns {
            display: flex;
            flex-wrap: wrap; /* Memastikan kartu-kartu akan pindah ke baris baru jika tidak cukup lebar */
        }

        .card-columns .card {
            width: calc(20% - 1.10rem); /* Mengatur lebar setiap kartu, dengan margin yang dihilangkan */
            height: calc(20% - 1.10rem); /* Mengatur lebar setiap kartu, dengan margin yang dihilangkan */
            margin-bottom: 1.25rem; /* Menambahkan jarak antara kartu-kartu */
        }

        .card-columns .card .card-img {
            width: 100%; /* Menetapkan lebar gambar menjadi 100% */
            aspect-ratio: 1 / 1; /* Menetapkan tinggi gambar menjadi 100% */
            object-fit: cover; /* Membuat gambar mengisi seluruh area dengan mempertahankan aspek rasio */
        }

            @media (max-width: 1380px) {
                .card-columns .card {
                    width: calc(25% - 1.25rem); /* Mengatur lebar setiap kartu, dengan margin yang dihilangkan */
                    height: calc(25% - 1.25rem); /* Mengatur lebar setiap kartu, dengan margin yang dihilangkan */
                }
            }

            @media (max-width: 1050px) {
                .card-columns .card {
                    width: calc( 33.33% - 1.25rem); /* Mengatur lebar setiap kartu, dengan margin yang dihilangkan */
                    height: calc( 33.33% - 1.25rem); /* Mengatur lebar setiap kartu, dengan margin yang dihilangkan */
                }
            }

            @media (max-width: 780px) {
                /* line 256, node_modules/bootstrap/scss/_card.scss */
                .card-columns .card {
                    width: calc( 50% - 1.25rem); /* Mengatur lebar setiap kartu, dengan margin yang dihilangkan */
                    height: calc( 50% - 1.25rem); /* Mengatur lebar setiap kartu, dengan margin yang dihilangkan */
                }
                .card-columns {
                    justify-content: space-between; /* Menyebarkan kartu-kartu secara merata di sepanjang baris */
                }
            }

            @media (max-width: 520px) {
                .card-columns .card {
                    width: calc( 100% - 1.25rem); /* Mengatur lebar setiap kartu, dengan margin yang dihilangkan */
                    height: calc( 100%% - 1.25rem); /* Mengatur lebar setiap kartu, dengan margin yang dihilangkan */
                }

                .card-columns {
                    justify-content: center; /* Menyebarkan kartu-kartu secara merata di sepanjang baris */
                }
            }
    </style>
@endsection

@section('content')
    <div class="head container-fluid mb-4 mt-4">
        <h1 class="text-css font-weight-bold title mb-0">Collection of albums from {{$user->username}}</h1>
        @if(auth()->check() && auth()->user()->id === $user->id)
            <div data-toggle="modal" data-target="#addAlbum" class="m-2" style="text-decoration: none; margin-right: 40px; cursor: pointer;">
                <div class="d-flex align-items-center" style="padding: 10px 15px; height: 50px; width: fit-content; background-color: white; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; border-radius: 25px;">
                    <i class="bi bi-folder-plus text-dark" style="font-size: 20px"></i>
                    <span class="text-dark" style="font-size: 15px; font-weight: 600; margin-left: 5px">
                        Tambahkan Album
                    </span>
                </div>
            </div>
        @endif
    </div>

    <div class="container-fluid mb-5">
        <div class="card-columns">
            @if($albums->isEmpty())
                <div class="alert alert-warning" style="width: 100%" role="alert"> 
                    {{$user->username}} doesn't have an album yet
                </div>
            @else
                @foreach ($albums as $album)       
                    <div class="gambar-utama card card-pin">
                        <a href="{{ route('foto.album', ['id' => $album->id]) }}">
                            <img class="card-img" style="border-radius: 15px;" src="{{ $album->fotos->first() ? asset('storage/'.$album->fotos->first()->lokasi_file) : 'https://1.bp.blogspot.com/-1c4feMWtBew/YVEl9kpt6XI/AAAAAAAAEuM/6owYtkcDNxY9JH3Wco8SBqSNDM-ek9UYwCLcBGAsYHQ/s16000/icon-app-soft-blue-enhypen%2B%25281%2529.jpg' }}" alt="Card image">
                        </a>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a class="nav-link text-dark" style="padding-left: 5px">
                                <span style="color: black; font-size: 15px; font-weight: 700;">{{ Illuminate\Support\Str::limit($album->nama_album, 15) }} - {{$album->fotos()->count()}}</span>
                            </a>
                            <div>
                                <a style="padding-right: 5px">
                                    <span style="color: black; font-size: 14px;">
                                        @if(\Carbon\Carbon::parse($album->created_at)->diffInDays() > 7)
                                            {{ \Carbon\Carbon::parse($album->created_at)->format('j F Y') }}
                                        @else
                                            {{ \Carbon\Carbon::parse($album->created_at)->shortRelativeDiffForHumans()}}
                                        @endif
                                    </span>
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection