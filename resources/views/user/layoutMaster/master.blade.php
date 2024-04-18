<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="shortcut icon" href="{{ asset('gambar/logo-pic-pals.png') }}" type="image/x-icon">
        <title>@yield('title')</title>

        <!-- Font Awesome -->
        <script type="text/javascript">
            (function() {
                var css = document.createElement('link');
                css.href = 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';
                css.rel = 'stylesheet';
                css.type = 'text/css';
                document.getElementsByTagName('head')[0].appendChild(css);
            })();
            </script>
    
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('assetsUser/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('assetsUser/css/theme.css') }}">
    
        <!-- Bootstrap Icons CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    
        <!-- Filepond CSS -->
        <link rel="stylesheet" href="{{ asset('assets/extensions/filepond/filepond.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
    
        <!-- Toastify CSS -->
        <link rel="stylesheet" href="{{ asset('assets/extensions/toastify-js/src/toastify.css') }}">
    
        <!-- Toastr CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        @yield('style')
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
            .container-detail-post{
                display: grid; 
                grid-template-columns: 1fr 1fr; 
                grid-template-rows: fit-content(0);
            }
            #minimal-gambar{
                min-height:550px
            }
            @media (max-width: 800px) {
                .container-detail-post{
                    display: block;
                }
                #minimal-gambar{
                    min-height:0px
                }
                .card-body-d{
                    width: 100%;
                }
                #modalImage {
                    width: 100%;
                    border-top-right-radius:15px;
                    border-bottom-right-radius:15px;
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
            <a class="navbar-brand font-weight-bolder mr-3" href="index.html">
                <img width="50px" src="{{ asset('gambar/logo-pic-pals.png') }}">
            </a>
            <button class="navbar-light navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDefault" aria-controls="navbarsDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsDefault">
                <ul class="navbar-nav mr-auto align-items-center">
                    <form class="bd-search hidden-sm-down">
                        <input type="text" class="form-control bg-graylight border-0 font-weight-bold" id="search-input" placeholder="Search..." autocomplete="off">
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
                            <img class="rounded-circle mr-2" src="{{ auth()->user()->foto_profile ? asset('storage/' . auth()->user()->foto_profile) : asset('assetsUser/img/av.png') }}" width="30" height="30" style="object-fit: cover;"> 
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
            @yield('content')
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
                        <a target="_blank" class="text-dark" href="https://www.wowthemes.net/pintereso-free-html-bootstrap-template/"><u>Pintereso Bootstrap HTML Template</u> by WowThemes.net.</a>
                    </span>
                </p>
            </div>
        </footer>
        
        {{-- MODAL ADD ALBUM --}}
        <div class="modal bottom fade" style="overflow-y: scroll;" id="addAlbum" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0" style="border-radius: 8px;">
                    <div class="modal-body p-3 d-flex align-items-center bg-none">
                        <div class="btn btn-light" style="position: absolute; top: 10px; right: 0; z-index: 999; background-color: transparent; border: none" data-dismiss="modal">
                            <span class="bi bi-x-lg text-dark" style="font-size: 20px"></span> <!-- Ganti dengan icon sesuai kebutuhan -->
                        </div>
                        <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                            <div class="rounded-0 text-left">
                                <h1 class="card-title display-4 mb-0 text-dark" style="text-align: center">Create Your Album!</h1>
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <span class="mb-4 mt-0" style="color: gray; text-align: center; width: 100%; font-weight: 600">Organize Your Memories by Creating New Albums</span>
                                </div>
                                <form id="createAlbumForm" method="POST" style="padding-left: 40px; padding-right: 40px">
                                    @csrf
                                    <div class="form-group icon-input mb-3" style="position: relative;">
                                        <i class="bi bi-file-text" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                        <input type="text" name="nama_album" id="nama_album" class="input-1  ps-5 font-xsss fw-600 pl-5" required>
                                        <label placeholder="Title" alt="Title"></label>
                                    </div>
                                    <div class="form-group icon-input mb-3">  
                                        <textarea name="deskripsi_album" id="deskripsi_album" class="ps-5 form-control text-grey-900 font-xsss fw-600" style="border: 2px solid #b3b3b3; border-radius: 8px; padding-top:10px; padding-bottom: 10px " placeholder="Description" rows="1" oninput="autoResize(this)"></textarea>
                                    </div>
                                    <div class="col-sm-12 p-0 text-left">
                                        <div class="form-group mb-3">
                                            <button style="background-color: #101126; border-radius:10px; height: 50px; cursor: pointer;" type="submit" class="form-control text-center text-white fw-600 border-0 py-2">
                                                <span style="font-weight: 600">Add Album</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL POST --}}
        <div class="modal bottom fade" style="overflow-y: scroll;" id="Modalpost" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0" style="border-radius: 8px;">
                    <div class="modal-body p-3 d-flex align-items-center bg-none">
                        <div class="btn btn-light" style="position: absolute; top: 10px; right: 0; z-index: 999; background-color: transparent; border: none" data-dismiss="modal">
                            <span class="bi bi-x-lg text-dark" style="font-size: 20px"></span> <!-- Ganti dengan icon sesuai kebutuhan -->
                        </div>
                        <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                            <div class="rounded-0 text-left">
                                <h1 class="card-title display-4 mb-0 text-dark" style="text-align: center">Let's Fill Your Gallery!</h1>
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <span class="mb-4 mt-0" style="color: gray; text-align: center; width: 100%; font-weight: 600">Share Your Moments by Uploading Photos Now</span>
                                </div>
                                <form id="postFoto" action="#" method="POST" enctype="multipart/form-data" style="padding-left: 40px; padding-right: 40px">
                                    @csrf
                                    <div class="form-group icon-input mb-3" style="position: relative">
                                        <i class="bi bi-file-text" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                        <input type="text" name="judul_foto" class="input-1  ps-5 font-xsss fw-600 pl-5" required>
                                        <label placeholder="Title" alt="Title"></label>
                                    </div>
                                    <div class="form-group icon-input mb-3">
                                        <textarea name="deskripsi_foto" id="style-2" class="ps-5 form-control text-grey-900 font-xsss fw-600" style="border: 2px solid #b3b3b3; border-radius: 8px" placeholder="Description" rows="1" oninput="autoResize(this)"></textarea>
                                    </div>
                                    <div class="form-group icon-input mb-3">
                                        <select name="kategori" class="ps-5 form-control text-grey-900 font-xsss fw-600" style="border: 2px solid #b3b3b3; border-radius: 8px;">
                                            <option value="" selected>Select Category</option>
                                            @foreach ($categorys as $category) 
                                                <option value="{{$category->id}}">{{$category->judul_kategori}}</option>
                                            @endforeach
                                        </select>
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
                                        <select name="album" class="style-2-input ps-5 form-control text-grey-900 font-xsss fw-600" style="border: 2px solid #b3b3b3; border-radius: 8px">
                                            <option disabled selected>Select your album</option>
                                            @if($albums && $albums->count() > 0)
                                            @foreach ($albums as $albumItem) 
                                                    <option value="{{$albumItem->id}}">{{$albumItem->nama_album}}</option>
                                                @endforeach
                                            @else
                                                <option disabled>No album available</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div id="newAlbumSection" class="form-group icon-input mb-3" style="display: none; position: relative;">
                                        <i class="bi bi-journal-album" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                        <input type="text" name="new_album" class="input-1  ps-5 font-xsss fw-600 pl-5">
                                        <label placeholder="New Album" alt="New Album"></label>
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
                                            <button style="background-color: #101126; border-radius:10px; height: 50px; cursor: pointer;" type="submit" class="form-control text-center text-white fw-600 border-0 py-2">
                                                <span style="font-weight: 600">Post</span>
                                            </button>
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
                <div class="modal-content border-0" style="border-radius: 8px;">
                    <div class="modal-body p-3 d-flex align-items-center bg-none">
                        <div class="btn btn-light" style="position: absolute; top: 10px; right: 0; z-index: 999; background-color: transparent; border: none" data-dismiss="modal">
                            <span class="bi bi-x-lg text-dark" style="font-size: 20px"></span> <!-- Ganti dengan icon sesuai kebutuhan -->
                        </div>
                        <div class="card shadow-none rounded-0 w-100 pt-1 p-2 border-0">
                            <div class=" rounded-0 text-left">
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <img width="70px" src="{{ asset('gambar/logo-pic-pals.png') }}">
                                </div>
                                <h1 class="card-title display-4 mb-0 text-dark" style="text-align: center">Let's Get Started</h1>
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <span class="mb-4 mt-0" style="color: gray; text-align: center; width: 100%; font-weight: 600">Welcome back! Please enter your details</span>
                                </div>
                                <form action="/authUser" method="POST" style="padding-left: 40px; padding-right: 40px">
                                    @csrf
                                    <div class="form-group icon-input mb-3" style="position: relative;">
                                        <i class="bi bi-envelope-fill" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                        <input type="text" name="email" id="email" class="input-1  ps-5 font-xsss fw-600 pl-5" required>
                                        <label placeholder="Email" alt="Email"></label>
                                    </div>
                                    <div class="form-group icon-input mb-3" style="position: relative;">
                                        <i class="bi bi-eye-fill" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                        <input type="password" name="password" id="password" class="input-1  ps-5 font-xsss fw-600 pl-5" required>
                                        <label placeholder="Password" alt="Password"></label>
                                    </div>
    
                                    <div class="col-sm-12 p-0 text-left">
                                        <div class="form-group mb-3">
                                            <button style="background-color: #101126; border-radius:10px; height: 50px; cursor: pointer;" type="submit" class="form-control text-center text-white fw-600 border-0 py-2">
                                                <span style="font-weight: 600">Sign In</span>
                                            </button>
                                        </div>
                                        <h6 class="text-grey-500 font-xs fw-400 mt-0 mb-3 lh-12" style="text-align: center; color: gray cursor: pointer;">Don't have an account? <a href="#" class="fw-700 ms-1" style="color: #169EF2" id="registerLink">Register</a></h6>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        @if(auth()->check() && auth()->id() === $user->id)
            {{-- MODAL EDIT PROFILE --}}
            <div class="modal bottom fade" style="overflow-y: scroll;" id="editProfile" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content border-0" style="border-radius: 8px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
                        <div class="modal-body p-3 d-flex align-items-center bg-none">
                            <div class="btn btn-light" style="position: absolute; top: 10px; right: 0; z-index: 999; background-color: transparent; border: none" data-dismiss="modal">
                                <span class="bi bi-x-lg text-dark" style="font-size: 20px"></span> <!-- Ganti dengan icon sesuai kebutuhan -->
                            </div>
                            <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                                <div class="rounded-0 text-left">
                                    <h1 class="card-title display-4 mb-4" style="text-align: center">Edit Profile</h1>
                                    <form id="updateProfileForm" enctype="multipart/form-data" method="POST" style="padding-left: 40px; padding-right: 40px">
                                        @csrf
                                        <div class="form-group icon-input mb-1" style="position: relative;">
                                            <i class="bi bi-envelope-fill" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                            <input type="text" name="email" id="email" class="input-1  ps-5 font-xsss fw-600 pl-5" type="text" required value="{{$user->email}}">
                                            <label placeholder="Email" alt="Email"></label>
                                        </div>
                                        <div class="form-group icon-input mb-1" style="position: relative;">
                                            <i class="bi bi-person-circle" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                            <input type="text" name="username" id="username" class="input-1  ps-5 font-xsss fw-600 pl-5" type="text" required value="{{$user->username}}">
                                            <label placeholder="Username" alt="Username"></label>
                                        </div>
                                        <div class="form-group icon-input mb-1" style="position: relative;">
                                            <i class="bi bi-person-fill" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                            <input type="text" name="nama_lengkap" id="nama_lengkap"  class="input-1  ps-5 font-xsss fw-600 pl-5" type="text" required value="{{$user->nama_lengkap}}">
                                            <label placeholder="Full Name" alt="Full Name"></label>
                                        </div>
                                        <div class="form-group icon-input mb-1" style="position: relative;">
                                            <i class="bi bi-house-fill" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                            <input type="text" name="alamat" id="alamat" class="input-1  ps-5 font-xsss fw-600 pl-5" type="text" required value="{{$user->alamat}}">
                                            <label placeholder="Address" alt="Address"></label>
                                        </div>
                                        <div class="form-group icon-input mb-3" style="position: relative">
                                            <i class="bi bi-eye-fill" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                            <input type="password" name="password_old" class="input-1  ps-5 font-xsss fw-600 pl-5" type="text">
                                            <label placeholder="Confirm Password" alt="Confirm Password"></label>
                                        </div>
                                        <div class="form-group icon-input mb-3" style="position: relative">
                                            <i class="bi bi-eye-fill" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                            <input type="password" name="password_new" class="input-1  ps-5 font-xsss fw-600 pl-5" type="text">
                                            <label placeholder="New Password" alt="New Password"></label>
                                        </div>
                                        <div class="card">     
                                            <label class="text-dark" style="font-weight: bold">Foto Profile</label>                 
                                            <input type="file" name="photo_profile" class="image-crop-filepond" image-crop-aspect-ratio="1:1">
                                        </div>
                                        <div class="col-sm-12 p-0 text-left">
                                            <div class="form-group mb-3 mt-1">
                                                <button style="background-color: #101126; border-radius:10px; height: 50px; cursor: pointer;" type="submit" class="form-control text-center text-white fw-600 border-0 py-2">
                                                    <span style="font-weight: 600">Udate Profile</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- MODAL REGISTER --}}
            <div class="modal bottom fade" style="overflow-y: scroll;" id="ModalRegister" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content border-0" style="border-radius: 8px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti-close text-grey-500"></i></button>
                        <div class="modal-body p-3 d-flex align-items-center bg-none">
                            <div class="btn btn-light" style="position: absolute; top: 10px; right: 0; z-index: 999; background-color: transparent; border: none" data-dismiss="modal">
                                <span class="bi bi-x-lg text-dark" style="font-size: 20px"></span> <!-- Ganti dengan icon sesuai kebutuhan -->
                            </div>
                            <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                                <div class="rounded-0 text-left">
                                    <div style="display: flex; justify-content: center; align-items: center;">
                                        <img width="70px" src="{{ asset('gambar/logo-pic-pals.png') }}">
                                    </div>
                                    <h1 class="card-title display-4 mb-0 text-dark" style="text-align: center">Create Your Account</h1>
                                    <div style="display: flex; justify-content: center; align-items: center;">
                                        <span  class="mb-4 mt-0" style="color: gray; text-align: center; width: 100%; font-weight: 600">Complete the form below to create your account.</span>
                                    </div>
                                    <form action="/registerUser" method="POST" enctype="multipart/form-data" style="padding-left: 40px; padding-right: 40px">
                                        @csrf
                                        <div class="form-group icon-input mb-1" style="position: relative;">
                                            <i class="bi bi-envelope-fill" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                            <input type="text" name="email" id="email" class="input-1  ps-5 font-xsss fw-600 pl-5" type="text" required>
                                            <label placeholder="Email" alt="Email"></label>
                                        </div>
                                        <div class="form-group icon-input mb-1" style="position: relative;">
                                            <i class="bi bi-person-circle" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                            <input type="text" name="username" id="username" class="input-1  ps-5 font-xsss fw-600 pl-5" type="text" required>
                                            <label placeholder="Username" alt="Username"></label>
                                        </div>
                                        <div class="form-group icon-input mb-1" style="position: relative;">
                                            <i class="bi bi-person-fill" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                            <input type="text" name="nama_lengkap" id="nama_lengkap"  class="input-1  ps-5 font-xsss fw-600 pl-5" type="text" required>
                                            <label placeholder="Full Name" alt="Full Name"></label>
                                        </div>
                                        <div class="form-group icon-input mb-1" style="position: relative;">
                                            <i class="bi bi-house-fill" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                            <input type="text" name="alamat" id="alamat" class="input-1  ps-5 font-xsss fw-600 pl-5" type="text" required>
                                            <label placeholder="Address" alt="Address"></label>
                                        </div>
                                        <div class="form-group icon-input mb-1" style="position: relative;">
                                            <i class="bi bi-eye-fill" style="position: absolute; top: 70%; transform: translateY(-50%); left: 10px; font-size: 1.5em; color: #b3b3b3"></i>
                                            <input type="password" name="password" id="password" class="input-1  ps-5 font-xsss fw-600 pl-5" type="text" required>
                                            <label placeholder="Password" alt="Password"></label>
                                        </div>
                                        <div class="card">                           
                                            <input type="file" name="photo_profile" class="image-crop-filepond" image-crop-aspect-ratio="1:1">
                                        </div>
                                        <div class="col-sm-12 p-0 text-left mb-3">
                                            <button style="background-color: #101126; border-radius:10px; height: 50px; cursor: pointer;" type="submit" class="form-control text-center text-white fw-600 border-0 py-2">
                                                <span style="font-weight: 600">Sign In</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    
    </body>
    <script src="{{ asset('assetsUser/js/app.js') }}"></script>
    <script src="{{ asset('assetsUser/js/theme.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond/filepond.js') }}"></script>
    <script src="{{ asset('assets/extensions/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/filepond.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        // AJAX TAMBAH ALBUM
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('createAlbumForm');
    
            form.addEventListener('submit', function(event) {
                event.preventDefault();
    
                var formData = new FormData(form);
                formData.append('_token', '{{ csrf_token() }}');
    
                fetch('/store-album', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    toastr.success('Album added successfully', 'Success', { 
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
                            location.reload();
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal membuat album.');
                });
            });
        });
        
        // AJAX UPDATE PROFILE
        $(document).ready(function() {
            $('#updateProfileForm').submit(function(e) {
                e.preventDefault();
                
                var formData = new FormData($(this)[0]);
                var userId = '{{ $user ? $user->id : null }}';
    
                $.ajax({
                    url: '/update-user/' + userId,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Tampilkan pesan sukses menggunakan toastr
                        toastr.success(response.message, 'Success', { 
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
                                window.location.href = '/profile/'+ userId;
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        var response = JSON.parse(xhr.responseText);
                        toastr.error(response.error, 'Error', { 
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
                            "toastClass": "toast-red-solid" 
                        });
                    }
                });
            });
        });

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
        
        // AJAX KIRIM LIKE 
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
                        toastr.success('Post successfully uploaded', 'Success', { 
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
                                window.location.href = '/pic-pals';
                            }
                        });
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