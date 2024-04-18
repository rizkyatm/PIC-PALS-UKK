@extends('user.layoutMaster.master')

@section('title', 'Profile - Pic Pals')

@section('style')
    <style>
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
            justify-content: first baseline; /* Menyebarkan kartu-kartu secara merata di sepanjang baris */
        }

        .card-columns .card {
            width: calc(20% - 1.25rem); /* Mengatur lebar setiap kartu, dengan margin yang dihilangkan */
            height: calc(20% - 1.25rem); /* Mengatur lebar setiap kartu, dengan margin yang dihilangkan */
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
    <a href="/pic-pals" class="m-2" style="position: absolute; left: 50px;">
        <div style="height: 50px; width: 50px; background-color: white; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; display: flex; justify-content: center; align-items: center; border-radius: 50%">
            <i class="bi bi-arrow-left-short text-dark" style="font-size: 50px"></i>
        </div>
    </a>
    <div class="container mb-4 d-flex flex-column justify-content-center align-items-center mt-4">
            <img src="{{ $user->foto_profile ? asset('storage/'.$user->foto_profile) : asset('assetsUser/img/av.png') }}" class="mb-4 rounded-circle" width="128" height="128" style="object-fit: cover;">
            <h1 class="font-weight-bold title mb-0">{{$user->username}}</h1>
            <p class="mb-0" style="font-size: 20px; font-weight: 600; color: #808080">
                {{$user->nama_lengkap}} | {{$user->email}} | {{$user->alamat}}
            </p>
            <div style="display: flex;">
                    @if(auth()->check() && auth()->user()->id === $user->id)
                        <button type="button" class="btn btn-gray200 mb-3 mt-2 text-dark" style="background-color: #F2F2F2; width: 250px; margin-right: 5px; margin-left: 5px " data-toggle="modal" data-target="#editProfile">
                            <span class="bi bi-pencil-square"></span>  Edit Profile
                        </button>
                    @endif
                    
                    <a href="/albums/{{$user->id}}" class="btn btn-gray200 mb-3 mt-2 text-dark" style="background-color: #F2F2F2; width: 250px; margin-left: 5px; margin-right: 5px">
                        <span class="bi bi-pencil-square"></span>  Albums {{$user->username}}
                    </a>
            </div>
            <div class="d-flex justify-content-center">
                <div class="d-flex align-items-center" style="background-color: #132B40; border-radius: 50px; padding: 10px 15px; margin: 0 5px;">
                    <a class="text-white">{{$totalPost}} Posts</a>
                </div>
                <div class="d-flex align-items-center" style="background-color: #132B40; border-radius: 50px; padding: 10px 15px; margin: 0 5px;">
                    <a class="text-white">{{ $totalLike }} likes</a>
                </div>
                <div class="d-flex align-items-center" style="background-color: #132B40; border-radius: 50px; padding: 10px 15px; margin: 0 5px;">
                    <a class="text-white">{{$totalAlbum}} albums</a>
                </div>
            </div>
            

    </div>
    <div class="container-fluid mb-5">
        <div class="card-columns">
            @if($fotos->isEmpty())
                <div class="alert alert-warning" style="width: 100%" role="alert"> 
                    There are no posts from {{$user->username}} yet
                </div>
            @else
                @foreach ($fotos as $foto)       
                    <div class="gambar-utama card card-pin">
                        <div href="" data-toggle="modal" onclick="openModalAndProfile(event, {{$foto->id}}, {{$foto->user->id}})">
                            <img class="card-img" style="border-radius: 15px;" src="{{ asset('storage/' . $foto->lokasi_file) }}" alt="Card image">
                            <div class="overlay" style="border-radius: 15px;">
                                <div style=" display: flex; justify-content: space-between; align-items: center; margin-top: 80%">
                                    <a href="/profile/{{$foto->user->id}}" class="nav-link text-dark" style="padding-left: 5px">
                                        @if ($foto->user->foto_profile)
                                            <img class="rounded-circle mr-2 " src="{{ asset('storage/'.$foto->user->foto_profile) }}" alt="" width="30" height="30" style="object-fit: cover;">
                                        @else
                                            <img class="rounded-circle mr-2" src="{{ asset('assetsUser/img/av.png') }}" alt="" width="30">
                                        @endif
                                        <span style="color: white" class="align-middle">{{ $foto->user->username }}</span>
                                    </a>
                                    <div>
                                        <a style="padding-right: 5px">
                                            <span style="color: white; font-size: 12px; text-transform: uppercase;">
                                                @if(\Carbon\Carbon::parse($foto->created_at)->diffInDays() > 7)
                                                    {{ \Carbon\Carbon::parse($foto->created_at)->format('j F Y') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($foto->created_at)->diffForHumans()}}
                                                @endif
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function openModalAndProfile(event, fotoId, userId) {
                                // Mencegah perilaku default dari elemen <a>
                                event.preventDefault();
                                
                                // Mengecek apakah bagian dari elemen yang diklik adalah bagian yang menunjukkan profil pengguna
                                var isProfileLinkClicked = event.target.closest('.nav-link') !== null;
                                
                                // Jika yang diklik adalah bagian profil pengguna, arahkan ke profil pengguna
                                if (isProfileLinkClicked) {
                                    window.location.href = '/profile/' + userId;
                                } else {
                                    openModal(fotoId);
                                    // Jika yang diklik bukan bagian profil pengguna, buka modal
                                    // $('#imageModal_' + fotoId).modal('show');
                                }
                            }
                        </script>
                    </div>
                    
                    <!-- MODAL DETAIL GAMBAR -->
                    <div class="modal bottom fade" style="overflow-y: scroll; padding-right:0 " id="imageModal_{{ $foto->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg d-flex justify-content-center align-items-center"  id="dialog_modal" role="document">
                            <div class="modal-content" style="border-radius: 15px;">
                                <div class="container-detail-post">
                                    {{-- DIV GAMBAR --}}
                                    <div>
                                        <div class="btn btn-light" style="position: absolute; top: 15px; left: 0; z-index: 999; background-color: transparent; border: none" data-dismiss="modal">
                                            <span class="bi bi-x-circle-fill text-white"></span> <!-- Ganti dengan icon sesuai kebutuhan -->
                                        </div>
                                        <div id="minimal-gambar">
                                            <img style="border-top-left-radius: 15px; border-bottom-left-radius: 15px;" id="modalImage" src="{{ asset('storage/' . $foto->lokasi_file) }}" alt="Image">
                                        </div>
                                    </div>
                                    {{-- DIV DETAIL --}}
                                    <div id="style-2" class="card-body card-body-d" style="overflow-y: auto; width: 100%; padding-top:0; margin-top: 20px">
                                        <div style="background-color: white; position: sticky; top: 0; z-index: 999;">
                                            <h1 class="card-title display-4" style="">{{ $foto->judul_foto }}</h1>
                                            <span>{{ $foto->deskripsi_foto }}</span>
                                            <hr style="border: transparent">
                                            <div class="d-flex mb-3" style="justify-content: space-between">
                                                <div class="d-flex">
                                                    <a href="/profile/{{$foto->user->id}}" class="text-dark" style="display: flex; align-items: center; text-decoration: none">
                                                        <img src="{{ $foto->user->foto_profile ? asset('storage/' . $foto->user->foto_profile) : asset('assetsUser/img/av.png') }}" alt="" class="img-circle" style="border-radius: 40px; width: 40px; height: 40px; object-fit: cover;">
                                                        <div style="margin-left: 10px">
                                                            <div class="mb-0" style="font-size: 15px; font-weight: 600">{{$foto->user->username}}</div>
                                                            <div  style="font-size: 12px">{{ $foto->user->fotos->count() }} Post</div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-gray200 tombol2" style="background-color: #3370A6; color: white;">
                                                <span class="bi bi-calendar-week"></span>                                                            
                                                @if(\Carbon\Carbon::parse($foto->created_at)->diffInDays() > 7)
                                                    {{ \Carbon\Carbon::parse($foto->created_at)->format('j F Y') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($foto->created_at)->diffForHumans()}}
                                                @endif
                                            </button>
                                            <a href="{{ $foto->album_id ? route('foto.album', ['id' => $foto->album_id]) : '#' }}" type="button" class="btn btn-gray200 tombol2" style="background-color: #3370A6; color: white;">
                                                <span class="bi bi-journal-album"></span>  {{$foto->album_id ? $foto->album->nama_album : 'Doesnt have an album'}}
                                            </a>
                                            <div>
                                                <button type="button" class="btn btn-like btn-gray200 tombol-1" style="background-color: #445985;color: white" id="likeButton_{{ $foto->id }}" data-photoid="{{ $foto->id }}">
                                                    <span class="bi bi-suit-heart"></span> 
                                                    <span id="likeCount_{{ $foto->id }}">{{ $foto->likes_count }} likes</span>
                                                </button>
                                                <a href="{{ asset('storage/' . $foto->lokasi_file) }}" download>
                                                    <button type="button" class="btn btn-gray200 tombol-1" style="background-color: #6997BF; color: white;">
                                                        <span class="bi bi-download"></span> Download
                                                    </button>
                                                </a>
                                                <button type="button" class="btn btn-gray200 tombol-1"  style="background-color: #243D6A;color: white;">
                                                    <span class="bi bi-exclamation-triangle"></span>  Report
                                                </button>
                                                @if($foto->user->id == auth()->id())
                                                    <button type="button" class="btn btn-gray200 tombol-1" style="background-color: #cd4545; color: white;" onclick="event.preventDefault(); deleteFoto({{ $foto->id }});">
                                                        <span class="bi bi-exclamation-triangle"></span> Delete
                                                    </button>
                                                    <form id="deleteForm_{{ $foto->id }}" action="{{ route('delete.photo', $foto->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                    
                                                @endif
                                            </div>
                                            <form action="{{ route('comments.photo') }}" method="POST" class="commentForm  mt-4">
                                                @csrf
                                                <div style="display: flex; align-items: flex-end; justify-content: space-between;">
                                                    <textarea style="margin-right: 5px;" name="isi_komentar" class="form-control" placeholder="write a comment..." rows="1" oninput="autoResize(this)"></textarea>
                                                    <input type="hidden" name="foto_id" value="{{ $foto->id }}">
                                                    <button type="submit" style="height: 40px; background-color: #132B40; color: white" class="btn btn-info"><i class="bi bi-send"></i></button>
                                                </div>
                                            </form>
                                            <div style="background-color: white">
                                                <h3  class="card-title display-4 mb-1 mt-2" style="font-size:20px">
                                                    Comments (<span id="commentCount_{{ $foto->id }}">0</span>)
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="panel panel-info comment-wrapper" style="background-color: white">
                                            <hr class="mt-1">
                                            <div class="panel-body" id="style-2">
                                                <ul id="commentList_{{ $foto->id }}" class="media-list" style="padding: 0">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- MODAL DETAIL GAMBAR END -->
                @endforeach
            @endif
        </div>
    </div>
@endsection