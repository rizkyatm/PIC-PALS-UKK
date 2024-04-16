<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home - Pic Pals</title>
    <script type="text/javascript">
        (function() {
            var css = document.createElement('link');
            css.href = 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';
            css.rel = 'stylesheet';
            css.type = 'text/css';
            document.getElementsByTagName('head')[0].appendChild(css);
        })();
    </script>
    <link rel="stylesheet" href="assetsUser/css/app.css">
    <link rel="stylesheet" href="assetsUser/css/theme.css">

    <!-- Tambahkan Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    {{--TAMBAHAN --}}
    <link rel="stylesheet" href="assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    <link rel="stylesheet" href="assets/extensions/toastify-js/src/toastify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


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
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <a class="navbar-brand font-weight-bolder mr-3" href="index.html"><img width="50px" src="gambar/logo-pic-pals.png"></a>
        <button class="navbar-light navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsDefault">
            <ul class="navbar-nav mr-auto align-items-center">
                <form class="bd-search hidden-sm-down">
                    <input type="text" class="form-control bg-graylight border-0 font-weight-bold" id="search-input"
                        placeholder="Search..." autocomplete="off">
                    <div class="dropdown-menu bd-search-results" id="search-results">
                    </div>
                </form>
            </ul>
            <ul class="navbar-nav ml-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" href="/pic-pals">Home</a>
                </li>
                @if (auth()->check())
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#Modalpost">Add Post</a>
                </li>
                <li class="nav-item">
                    <a href="/profile/{{ auth()->user()->id }}" class="nav-link">
                        <img class="rounded-circle mr-2" src="{{ auth()->user()->foto_profile ? asset('storage/' . auth()->user()->foto_profile) : asset('assetsUser/img/av.png') }}"  width="30" height="30" style="object-fit: cover;"> 
                        <span class="align-middle">{{ auth()->user()->username }}</span>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <div style="border-radius: 20px; background-color: #132B40;" class="py-1 px-2">
                        <a class="nav-link text-white" href="#" data-toggle="modal" data-target="#Modallogin">Login</a>
                    </div>
                </li>
                    @endif
                @if (auth()->check())
                <li class="nav-item">
                    <div style="border-radius: 20px; background-color: #132B40;" class="py-1 px-2">
                        <a class="nav-link text-white" href="/logout">Logout</a>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </nav>

    <main role="main">
        <section class="mt-4 mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="card-columns">
                        @foreach ($fotos as $foto)
                            @if($foto)
                                <div class="gambar-utama card card-pin">
                                    {{-- <div href="" data-toggle="modal" data-target="#imageModal_{{ $foto->id }}" onclick="openModal({{ $foto->id }})"> --}}
                                        <div href="" data-toggle="modal" onclick="openModalAndProfile(event, {{$foto->id}}, {{$foto->user->id}})">
                                            <img class="card-img" style="border-radius: 15px;" src="{{ asset('storage/' . $foto->lokasi_file) }}" alt="Card image">
                                            <div class="overlay" style="border-radius: 15px;">
                                                <div class="more" style="display: flex; justify-content: space-between; align-items:center">
                                                    <a href="/profile/{{$foto->user->id}}" class="nav-link text-dark" style="padding-left: 5px">
                                                        @if ($foto->user->foto_profile)
                                                            <img class="rounded-circle mr-2 " src="{{ asset('storage/'.$foto->user->foto_profile) }}" alt="" width="30" height="30" style="object-fit: cover;">
                                                        @else
                                                            <img class="rounded-circle mr-2" src="{{ asset('assetsUser/img/av.png') }}" alt="" width="30">
                                                        @endif
                                                        <span style="color: white" class="align-middle ">{{ $foto->user->username }}</span>
                                                    </a>
                                                    <div>
                                                        <a style="padding-right: 5px"><span style="color: white; font-size: 12px" id="timeElapsed{{ $foto->id }}"></span></a>
                                                        <span id="createdAt{{ $foto->id }}" style="display: none;">{{ $foto->created_at }}</span>
                                                        <span id="createdAt{{ $foto->id }}" style="display: none;">{{ $foto->created_at }}</span>
                                                    </div>
                                                </div>
                                                {{-- <h2 class="card-title title">Some Title</h2>
                                                <div style="display: flex; justify-content: space-between; align-items: center;" style="position: absolute; bottom: 0; right: 0; left: 0;">
                                                    <a href="/profile/{{$foto->user->id}}" class="nav-link text-dark" style="padding-left: 5px">
                                                        @if ($foto->user->foto_profile)
                                                            <img class="rounded-circle mr-2 " src="{{ asset('storage/'.$foto->user->foto_profile) }}" alt="" width="30">
                                                        @else
                                                            <img class="rounded-circle mr-2" src="{{ asset('assetsUser/img/av.png') }}" alt="" width="30">
                                                        @endif
                                                        <span style="color: white" class="align-middle">{{ $foto->user->username }}</span>
                                                    </a>
                                                    <div>
                                                        <a style="padding-right: 5px"><span style="color: white" id="timeElapsed{{ $foto->id }}"></span></a>
                                                        <span id="createdAt{{ $foto->id }}" style="display: none;">{{ $foto->created_at }}</span>
                                                    </div>
                                                </div> --}}
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
                                <div class="modal bottom fade" style="overflow-y: scroll;" id="imageModal_{{ $foto->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg d-flex justify-content-center align-items-center"  id="dialog_modal" role="document">
                                        <div class="modal-content" style="border-radius: 15px;">
                                            <div class="container-detail-post">
                                                {{-- DIV GAMBAR --}}
                                                <div>
                                                    <img style="border-top-left-radius: 15px; border-bottom-left-radius: 15px;" id="modalImage" src="{{ asset('storage/' . $foto->lokasi_file) }}" alt="Image">
                                                </div>

                                                {{-- DIV DETAIL --}}
                                                <div class="card-body card-body-d">
                                                    <h1 class="card-title display-4">{{ $foto->judul_foto }}</h1>
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
                                                        <button type="button" class="btn btn-gray200 text-dark">
                                                            <span class="bi bi-journal-album"></span>  {{$foto->album_id ? $foto->album->nama_album : 'Doesnt have an album'}}
                                                        </button>
                                                    </div>
                                                    <button type="button" class="btn btn-like btn-gray200" style="background-color: #445985;color: white" id="likeButton_{{ $foto->id }}" data-photoid="{{ $foto->id }}">
                                                        <span class="bi bi-suit-heart"></span> 
                                                        <span id="likeCount_{{ $foto->id }}">{{ $foto->likes_count }} likes</span>
                                                    </button>
                                                    <a href="{{ asset('storage/' . $foto->lokasi_file) }}" download>
                                                        <button type="button" class="btn btn-gray200" style="background-color: #6997BF; color: white">
                                                            <span class="bi bi-download"></span> Download
                                                        </button>
                                                    </a>
                                                    <button type="button" class="btn btn-gray200"  style="background-color: #243D6A;color: white">
                                                        <span class="bi bi-exclamation-triangle"></span>  Report
                                                    </button>
                                                    @if($foto->user->id == auth()->id())
                                                        <form id="deleteForm_{{ $foto->id }}" action="{{ route('delete.photo', $foto->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                        
                                                        <button type="button" class="btn btn-gray200" style="background-color: #cd4545; color: white" onclick="event.preventDefault(); deleteFoto({{ $foto->id }});">
                                                            <span class="bi bi-exclamation-triangle"></span> Delete
                                                        </button>
                                                    @endif
                                                    
                                                    <div class="panel panel-info comment-wrapper mt-4">
                                                        <form action="{{ route('comments.photo') }}" method="POST" class="commentForm">
                                                            @csrf
                                                            <div style="display: flex; align-items: flex-end; justify-content: space-between;">
                                                                <textarea style="margin-right: 5px;" name="isi_komentar" class="form-control" placeholder="write a comment..." rows="1" oninput="autoResize(this)"></textarea>
                                                                <input type="hidden" name="foto_id" value="{{ $foto->id }}">
                                                                <button type="submit" style="height: 40px; background-color: #132B40; color: white" class="btn btn-info"><i class="bi bi-send"></i></button>
                                                            </div>
                                                        </form>
                                                        <h3  class="card-title display-4 mb-1 mt-2" style="font-size:20px">
                                                            Comments (<span id="commentCount_{{ $foto->id }}">0</span>)
                                                        </h3>
                                                        <hr class="mt-1">
                                                        <div class="panel-body" id="style-2" style="max-height: 265px; overflow-y: auto;">
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
                             @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

    </main>
    <footer class="footer pt-5 pb-5 text-center">
        <div class="container">
            <div class="socials-media">
                <ul class="list-unstyled">
                    <li class="d-inline-block ml-1 mr-1"><a href="#" class="text-dark"><i class="fa fa-facebook"></i></a></li>
                    <li class="d-inline-block ml-1 mr-1"><a href="#" class="text-dark"><i class="fa fa-twitter"></i></a></li>
                    <li class="d-inline-block ml-1 mr-1"><a href="#" class="text-dark"><i class="fa fa-instagram"></i></a></li>
                    <li class="d-inline-block ml-1 mr-1"><a href="#" class="text-dark"><i class="fa fa-google-plus"></i></a></li>
                    <li class="d-inline-block ml-1 mr-1"><a href="#" class="text-dark"><i class="fa fa-behance"></i></a></li>
                    <li class="d-inline-block ml-1 mr-1"><a href="#" class="text-dark"><i class="fa fa-dribbble"></i></a></li>
                </ul>
            </div>
            <p>©
                <span class="credits font-weight-bold">
                    <a target="_blank" class="text-dark"  href="https://www.wowthemes.net/pintereso-free-html-bootstrap-template/"><u>Pintereso Bootstrap HTML Template</u> by WowThemes.net.</a>
                </span>
            </p>
        </div>
    </footer>
</body>

{{-- MODAL POST --}}
<div class="modal bottom fade" style="overflow-y: scroll;" id="Modalpost" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
            <div class="modal-body p-3 d-flex align-items-center bg-none">
                <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                    <div class="card-body rounded-0 text-left p-3">
                        <h1 class="card-title display-4 mb-4" style="text-align: center">Upload Photos</h1>
                        <form id="postFoto" action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group icon-input mb-3">
                                <label for="judul_foto" class="text-dark" style="font-weight: bold">Title</label>
                                <input type="text" name="judul_foto" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Enter title">
                            </div>
                            <div class="form-group icon-input mb-3">
                                <label for="deskripsi_foto" class="text-dark" style="font-weight: bold">Description</label>
                                <textarea name="deskripsi_foto" id="deskripsi_foto" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Enter description" rows="1" oninput="autoResize(this)"></textarea>
                            </div>
                            <div class="card">                           
                                <input type="file" name="lokasi_file" class="image-preview-filepond">
                            </div>
                            <div class="form-group icon-input mb-3">
                                <button type="button" class="btn btn-gray200" id="enterAlbumButton" style="background-color: #6997BF;color: white; width: 49.4%">
                                    <span class="bi bi-journal-album"></span>  Enter album
                                </button>
                                <button type="button" class="btn btn-gray200" id="enterNewAlbumButton" style="background-color: #6997BF;color: white; width: 49.4%">
                                    <span class="bi bi-journal-album"></span>  Enter new album
                                </button>
                            </div>
                            <div id="albumSection" class="form-group icon-input mb-3" style="display: none;">
                                <label for="album" class="text-dark" style="font-weight: bold">Album</label>
                                <select name="album" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600">
                                    @if($albums && $albums->count() > 0)
                                    <option disabled selected>Select your album</option>
                                    @foreach ($albums as $albumItem) 
                                            <option value="{{$albumItem->id}}">{{$albumItem->nama_album}}</option>
                                        @endforeach
                                    @else
                                        <option disabled>No album available</option>
                                    @endif
                                </select>
                            </div>
                            <div id="newAlbumSection" class="form-group icon-input mb-3" style="display: none;">
                                <label for="new_album" class="text-dark" style="font-weight: bold">New album</label>
                                <input type="text" name="new_album" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Enter new album">
                            </div>

                            <script>
                                document.getElementById("enterAlbumButton").addEventListener("click", function() {
                                    document.getElementById("albumSection").style.display = "block";
                                    document.getElementById("newAlbumSection").style.display = "none";
                                    document.getElementsByName("new_album")[0].value = ""; 
                                });
                            
                                document.getElementById("enterNewAlbumButton").addEventListener("click", function() {
                                    document.getElementById("albumSection").style.display = "none";
                                    document.getElementById("newAlbumSection").style.display = "block";
                                    document.querySelector("select[name='album']").selectedIndex = 0;
                                });
                            </script>
                            <div class="col-sm-12 p-0 text-left">
                                <div class="form-group mb-3">
                                    <button type="submit" class="form-control text-center style2-input text-white fw-600 bg-dark border-0 py-2" style="font-weight: bold">Post</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL LOGIN --}}
<div class="modal bottom fade" style="overflow-y: scroll;" id="Modallogin" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
            <div class="modal-body p-3 d-flex align-items-center bg-none">
                <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                    <div class="card-body rounded-0 text-left p-3">
                        <h2 class="fw-700 display1-size display2-md-size mb-4">Login into <br>your account</h2>
                        <form action="/authUser" method="POST">
                            @csrf
                            <div class="form-group icon-input mb-3" style="position: relative;">
                                <i class="bi bi-envelope-fill" style="position: absolute; top: 50%; transform: translateY(-50%); left: 10px; font-size: 1.5em;"></i>
                                <input type="text" name="email" id="email" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600 pl-5" placeholder="Your Email Address" style="padding-left: 30px;">
                            </div>
                            <div class="form-group icon-input mb-3" style="position: relative;">
                                <i class="bi bi-eye-fill" style="position: absolute; top: 50%; transform: translateY(-50%); left: 10px; font-size: 1.5em;"></i>
                                <input type="password" name="password" id="password" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600 pl-5" placeholder="Password" style="padding-left: 30px;">
                            </div>
                            {{-- <div class="form-check text-left mb-3">
                                <input type="checkbox" class="form-check-input mt-2" id="rememberMe">
                                <label class="form-check-label font-xsss text-grey-500" for="rememberMe">Remember me</label>
                                <a href="forgot.html" class="fw-600 font-xsss text-grey-700 mt-1 float-right">Forgot your Password?</a>
                            </div> --}}
                            <div class="col-sm-12 p-0 text-left">
                                <div class="form-group mb-3">
                                    <button type="submit"  class="form-control text-center style2-input text-white fw-600 bg-dark border-0 py-2">Login</button>
                                </div>
                                <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Don't have an account? <a href="#" class="fw-700 ms-1" id="registerLink">Register</a></h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL REGISTER --}}
<div class="modal bottom fade" style="overflow-y: scroll;" id="ModalRegister" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
            <div class="modal-body p-3 d-flex align-items-center bg-none">
                <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                    <div class="card-body rounded-0 text-left p-3">
                        <h2 class="fw-700 display1-size display2-md-size mb-4">Register into <br>your account</h2>
                        <form action="/registerUser" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                <input type="text" name="email" id="email" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Email">
                            </div>
                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                <input type="text" name="username" id="username" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Username">
                            </div>
                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group icon-input mb-3">
                                <i class="font-sm ti-email text-grey-500 pe-0"></i>
                                <input type="text" name="alamat" id="alamat" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Alamat">
                            </div>
                            <div class="form-group icon-input mb-3">
                                <input type="password" name="password" id="password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3" placeholder="Password">
                                <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                            </div>
                            <div class="card">                           
                                <input type="file" name="photo_profile" class="image-crop-filepond" image-crop-aspect-ratio="1:1">
                            </div>
                            <div class="col-sm-12 p-0 text-left">
                                <div class="form-group mb-3">
                                    <button type="submit"  class="form-control text-center style2-input text-white fw-600 bg-dark border-0 py-2">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="assetsUser/js/app.js"></script>
<script src="assetsUser/js/theme.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
<script src="assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
<script src="assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
<script src="assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
<script src="assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
<script src="assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
<script src="assets/extensions/filepond/filepond.js"></script>
<script src="assets/extensions/toastify-js/src/toastify.js"></script>
<script src="assets/static/js/pages/filepond.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<script>
    // TOMBOL UNTUK MENJALANKAN AJAX LIKE
    $(document).on('click', '.btn-like', function() {
        var photoId = $(this).data('photoid');
        toggleLike(photoId);
    });
    
    // TOMBOL UNTUK MENJALANKAN AJAX LIKE
    $(document).on('click', '.btn-unlike', function() {
        var photoId = $(this).data('photoid');
        toggleLike(photoId);
    });

    // AJAX HAPUS FOTO 
    function deleteFoto(photoId) {
        // Dapatkan token CSRF dari formulir
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
        // Kirim permintaan AJAX dengan token CSRF
        $.ajax({
            url: "/delete-foto/" + photoId,
            type: 'DELETE',
            data: {
                _token: csrfToken
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message, 'success');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    // Tampilkan pesan error
                    toastr.error(response.message, 'Error');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    // GET DATA SAAT BUKA MODAL
    function openModal(photoId) {
        loadComments(photoId);
        loadLikeStatus(photoId);
    }
    
    // GET LIKE BY FOTO_ID
    function loadLikeStatus(photoId) {
        $.ajax({
            url: "{{ route('get-like-status') }}",
            type: 'GET',
            data: {
                foto_id: photoId
            },
            dataType: 'json',
            success: function(response) {
                // Handle response here
                console.log(response);
    
                $('#likeCount_' + photoId).text(response.like_count + ' likes');
                // Toggle button text and class based on user's like status
                if (response.user_liked) {
                    $('#likeButton_' + photoId).removeClass('btn-like').addClass('btn-unlike');
                    $('#likeButton_' + photoId).html('<span style="color: #ff0000;" class="bi bi-suit-heart-fill"></span> <span id="likeCount_' + photoId + '">' + response.like_count + ' likes</span>');
                } else {
                    $('#likeButton_' + photoId).removeClass('btn-unlike').addClass('btn-like');
                    $('#likeButton_' + photoId).html('<span class="bi bi-suit-heart"></span> <span id="likeCount_' + photoId + '">' + response.like_count + ' likes</span>');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    
    // GET KOMENTAR BY FOTO_ID
    function loadComments(photoId) {
        $.ajax({
            url: "/get/comment/" + photoId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#imageModal').attr('data-target', '#imageModal_' + photoId);
                $('#imageModal_' + photoId).modal('show'); // Menampilkan modal
                console.log(response);
                var commentList = $('#commentList_' + photoId);
                commentList.empty(); // Bersihkan daftar komentar sebelum menambahkan yang baru
    
                // Tampilkan setiap komentar dalam daftar
                response.comments.forEach(function(comment) {
                    var commentItem = $('<li class="media"></li>');
                    var fotoProfile = comment.user.foto_profile ? 'storage/' + comment.user.foto_profile : 'assetsUser/img/av.png';

                    var commentContent = '<a href="/profile/' + comment.user.id + '" style="margin-right: 10px"><img src="' + fotoProfile + '"  alt="" class="img-circle" style="border-radius: 50px; width: 50px; height: 50px;object-fit: cover;"></a><div class="media-body mr-2"><span class="text-muted pull-right"><small class="text-muted">' + formatTimeAgo(comment.created_at) + '</small></span><a href="/profile/' + comment.user.id + '"><strong class="text-dark">' + comment.user.username + '</strong></a><p>' + comment.isi_komentar + '</p></div>';
                    commentItem.append(commentContent);
                    commentList.append(commentItem);
                });
    
                // Tampilkan jumlah komentar
                $('#commentCount_' + photoId).text(response.comments.length);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    
    // FORMAT WAKTU CREATE_AT
    function formatTimeAgo(timestamp) {
        const seconds = Math.floor((new Date() - new Date(timestamp)) / 1000);
    
        if (seconds < 60) {
            return `${Math.floor(seconds)}s ago`;
        }
        let interval = Math.floor(seconds / 31536000);
        if (interval > 1) {
            return `${interval} years`;
        }
        interval = Math.floor(seconds / 2592000);
        if (interval > 1) {
            return `${interval} months`;
        }
        interval = Math.floor(seconds / 86400);
        if (interval > 1) {
            return `${interval}d`;
        }
        interval = Math.floor(seconds / 3600);
        if (interval > 1) {
            return `${interval}h`;
        }
        interval = Math.floor(seconds / 60);
        if (interval > 1) {
            return `${interval}m`;
        }
        return formatTimeAgo(new Date(timestamp).getTime() + 1000);
    }
    
    // AJAX KIRIM KOMENTAR
    $(document).ready(function() {
        $('form.commentForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
    
            $.ajax({
                url: "{{ route('comments.photo') }}", 
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle respons dari server di sini
                    console.log(response);
                    $('textarea[name="isi_komentar"]').val('');
                    toastr.success('Comment sent successfully', 'Success', { "progressBar": false, "positionClass": "toast-top-right", "showDuration": "300", "hideDuration": "1000", "timeOut": "1500", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut", "closeButton": true, "toastClass": "toast-green-solid" });
                    loadComments(response.foto_id);
                },
                error: function(xhr, status, error) {
                    // Handle error di sini
                    console.error(xhr.responseText);
                    // Tampilkan notifikasi error dengan toastr.js
                    toastr.error('An error occurred while posting a comment', 'Error', { "progressBar": false, "positionClass": "toast-top-right", "showDuration": "300", "hideDuration": "1000", "timeOut": "1500", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut", "closeButton": true, "toastClass": "toast-red-solid" });
                }
            });
        });
    });
    
    // KIRIM LIKE 
    function toggleLike(photoId) {
        $.ajax({
            url: "{{ route('toggle-like') }}",
            type: 'POST',
            data: {
                foto_id: photoId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(response) {
                // Handle response here
                console.log(response);
                // Update like count
                $('#likeCount_' + photoId).text(response.like_count + ' likes');
                // Toggle button text and class based on user's like status
                if (response.action === 'liked') {
                    $('#likeButton_' + photoId).removeClass('btn-like').addClass('btn-unlike');
                    $('#likeButton_' + photoId).html('<span style="color: #ff0000;" class="bi bi-suit-heart-fill"></span> <span id="likeCount_' + photoId + '">' + response.like_count + ' likes</span>');
                    toastr.success('Photo liked successfully', 'Success', { "progressBar": false, "positionClass": "toast-top-right", "showDuration": "300", "hideDuration": "1000", "timeOut": "1500", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut", "closeButton": true, "toastClass": "toast-green-solid" });
                    
                } else {
                    $('#likeButton_' + photoId).removeClass('btn-unlike').addClass('btn-like');
                    $('#likeButton_' + photoId).html('<span class="bi bi-suit-heart"></span> <span id="likeCount_' + photoId + '">' + response.like_count + ' likes</span>');
                    toastr.success('Photo unliked successfully', 'Success', { "progressBar": false, "positionClass": "toast-top-right", "showDuration": "300", "hideDuration": "1000", "timeOut": "1500", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut", "closeButton": true, "toastClass": "toast-green-solid" });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                toastr.error('An error occurred while processing your like action', 'Error', { "progressBar": false, "positionClass": "toast-top-right", "showDuration": "300", "hideDuration": "1000", "timeOut": "1500", "extendedTimeOut": "1000", "showEasing": "swing", "hideEasing": "linear", "showMethod": "fadeIn", "hideMethod": "fadeOut", "closeButton": true, "toastClass": "toast-red-solid" });
            }
        });
    }
    
    //HEIGHT TEXT AREA
    function autoResize(textarea) {
        textarea.style.height = 'auto'; // Set ulang tinggi textarea ke nilai default
        textarea.style.height = (textarea.scrollHeight) + 'px'; // Atur tinggi textarea ke tinggi konten
    }

    // UNTUK FUNGSI TOMBOL REGISTER 
    $(document).ready(function () {
        // Tangani klik pada tautan "Register"
        $('#registerLink').click(function () {
            // Tutup modal login
            $('#Modallogin').modal('hide');
            // Buka modal register
            $('#ModalRegister').modal('show');
        });
    });

    // Fungsi untuk menghitung waktu yang sudah berlalu dan memperbarui tampilan
    function updateElapsedTime() {
        @foreach ($fotos as $foto)
        @if($foto)
            // Mendapatkan waktu foto dibuat dari server
            var createdAt{{ $foto->id }} = new Date(document.getElementById('createdAt{{ $foto->id }}').innerText);
            
            // Mendapatkan waktu sekarang
            var now = new Date();

            // Menghitung selisih waktu dalam milidetik
            var elapsedMilliseconds{{ $foto->id }} = now - createdAt{{ $foto->id }};

            // Menghitung selisih waktu dalam detik
            var elapsedSeconds{{ $foto->id }} = Math.floor(elapsedMilliseconds{{ $foto->id }} / 1000);

            // Variabel untuk menyimpan waktu yang sudah berlalu
            var timeElapsed{{ $foto->id }};

            // Mengupdate tampilan dengan waktu yang sudah berlalu sesuai kondisi
            if (elapsedSeconds{{ $foto->id }} < 60) {
                // Menampilkan waktu dalam detik jika kurang dari 1 menit
                timeElapsed{{ $foto->id }} = elapsedSeconds{{ $foto->id }} + ' seconds ago';
            } else if (elapsedSeconds{{ $foto->id }} < 3600) {
                // Menampilkan waktu dalam menit jika kurang dari 1 jam
                var elapsedMinutes{{ $foto->id }} = Math.floor(elapsedSeconds{{ $foto->id }} / 60);
                timeElapsed{{ $foto->id }} = elapsedMinutes{{ $foto->id }} + ' minutes ago';
            } else if (elapsedSeconds{{ $foto->id }} < 86400) {
                // Menampilkan waktu dalam jam jika kurang dari 1 hari
                var elapsedHours{{ $foto->id }} = Math.floor(elapsedSeconds{{ $foto->id }} / 3600);
                timeElapsed{{ $foto->id }} = elapsedHours{{ $foto->id }} + ' hours ago';
            } else if (elapsedSeconds{{ $foto->id }} < 2592000) {
                // Menampilkan waktu dalam hari jika kurang dari 30 hari (1 bulan)
                var elapsedDays{{ $foto->id }} = Math.floor(elapsedSeconds{{ $foto->id }} / 86400);
                timeElapsed{{ $foto->id }} = elapsedDays{{ $foto->id }} + ' days ago';
            } else {
                // Menampilkan tanggal jika lebih dari 1 bulan
                var day{{ $foto->id }} = createdAt{{ $foto->id }}.getDate();
                var month{{ $foto->id }} = createdAt{{ $foto->id }}.getMonth() + 1;
                var year{{ $foto->id }} = createdAt{{ $foto->id }}.getFullYear();
                timeElapsed{{ $foto->id }} = day{{ $foto->id }} + '-' + month{{ $foto->id }} + '-' + year{{ $foto->id }};
            }

            // Mengupdate tampilan dengan waktu yang sudah berlalu
            document.getElementById('timeElapsed{{ $foto->id }}').innerText = timeElapsed{{ $foto->id }};
        @endif
        @endforeach
    }

    // Memperbarui waktu yang sudah berlalu setiap detik
    setInterval(updateElapsedTime, 1000);

    // Memanggil fungsi updateElapsedTime() untuk pertama kali
    updateElapsedTime();

    // AJAX POST
    $(document).ready(function() {
        $('#postFoto').submit(function(e) {
            e.preventDefault(); // Menghentikan aksi bawaan formulir

            // Mengambil data formulir
            var formData = new FormData($(this)[0]);

            // Mengirim data ke server menggunakan Ajax
            $.ajax({
                url: "{{ route('store.photo') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle respons dari server di sini
                    console.log(response);
                    alert(response.message); // Contoh: Menampilkan pesan sukses
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error di sini
                    console.error(xhr.responseText);
                }
            });
        });
    });

    //ALERT
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
        });
    @endif

    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1000 // Tampilkan pesan sukses selama 2 detik
        }).then(() => {
            @if(Auth::user()->role === 'admin')
                window.location.href = '/Dashboard';
            @elseif(request()->path() !== 'pic-pals')
                window.location.href = '/pic-pals';
            @endif
        });
    @endif
</script>

</html>
