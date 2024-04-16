<!DOCTYPE html><html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Author - Pintereso Bootstrap Template</title>
        <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
        <link rel="stylesheet" href="{{ asset('assetsUser/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('assetsUser/css/theme.css') }}">
        {{-- TAMBAHAN --}}
        <!-- Bootstrap Icons CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <style>
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
    </head>
<body>



    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <a class="navbar-brand font-weight-bolder mr-3" href="index.html"><img width="50px" src="{{ asset('gambar/logo-pic-pals.png') }}"></a>
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
                    <a class="nav-link " href="/pic-pals">Home</a>
                </li>
                @if (auth()->check())
                <li class="nav-item">
                    <a href="/profile/{{auth()->user()->id}}" class="nav-link active">
                        <img class="rounded-circle mr-2" src="{{ auth()->user()->album_profile ? asset('storage/' . auth()->user()->album_profile) : asset('assetsUser/img/av.png') }}" width="30" height="30" style="object-fit: cover;"> 
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
        <div class="container mb-4 d-flex flex-column justify-content-center align-items-center mt-4">
            <h1 class="font-weight-bold title mb-0">Collection of albums from {{$user->username}}</h1>
        </div>
        <div class="container-fluid mb-5">
            <div class="card-columns">
                @if(auth()->check() && auth()->user()->id === $user->id)
                    <div class="gambar-utama card card-pin">
                        <div href="" data-toggle="modal" data-target="#addAlbum">
                            <img class="card-img" style="border-radius: 15px;" src="https://cdn-icons-png.flaticon.com/512/402/402716.png" alt="Card image">
                        </div>
                    </div>
                @endif
                {{-- MODAL ADD ALBUM --}}
                <div class="modal bottom fade" style="overflow-y: scroll;" id="addAlbum" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-0">
                            <div class="modal-body p-3 d-flex align-items-center bg-none">
                                <div class="card shadow-none rounded-0 w-100 p-2 pt-3 border-0">
                                    <div class="card-body rounded-0 text-left p-3">
                                        <h1 class="card-title display-4 mb-4" style="text-align: center">Add Album</h1>
                                        <form action="/store-album" method="POST">
                                            @csrf
                                            <div class="form-group icon-input mb-3">
                                                <label for="nama_album" class="text-dark" style="font-weight: bold">Title</label>
                                                <input type="text" name="nama_album" id="nama_album" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Title">
                                            </div>
                                            <div class="form-group icon-input mb-3">
                                                <label for="deskripsi_album" class="text-dark" style="font-weight: bold">Description</label>
                                                <input type="text" name="deskripsi_album" id="deskripsi_album" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600" placeholder="Description">
                                            </div>
                                            <div class="col-sm-12 p-0 text-left">
                                                <div class="form-group mb-3">
                                                    <button type="submit" class="form-control text-center style2-input text-white fw-600 bg-dark border-0 py-2">Add Album</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($albums as $album)       
                    <div class="gambar-utama card card-pin">
                        <a href="{{ route('foto.album', ['id' => $album->id]) }}">
                            <img class="card-img" style="border-radius: 15px;" src="https://1.bp.blogspot.com/-1c4feMWtBew/YVEl9kpt6XI/AAAAAAAAEuM/6owYtkcDNxY9JH3Wco8SBqSNDM-ek9UYwCLcBGAsYHQ/s16000/icon-app-soft-blue-enhypen%2B%25281%2529.jpg" alt="Card image">
                        </a>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a class="nav-link text-dark" style="padding-left: 5px">
                                <span style="color: black" class="align-middle">{{ $album->nama_album }}</span>
                            </a>
                            <div>
                                <a style="padding-right: 5px"><span style="color: black" id="timeElapsed{{ $album->id }}"></span></a>
                                <span id="createdAt{{ $album->id }}" style="display: none;">{{ $album->created_at }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> 
    </main>
    
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
        
            <!--
              All the links in the footer should remain intact.
              You may remove the links only if you donate:
              https://www.wowthemes.net/freebies-license/
            -->
          <p>©  <span class="credits font-weight-bold">        
            <a target="_blank" class="text-dark" href="https://www.wowthemes.net/pintereso-free-html-bootstrap-template/"><u>Pintereso Bootstrap HTML Template</u> by WowThemes.net.</a>
          </span>
          </p>
    
    
        </div>
        
    </footer>    

    
    <script src="{{ asset('assetsUser/js/app.js') }}"></script>
    <script src="{{ asset('assetsUser/js/theme.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/static/js/pages/filepond.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>              
        //HEIGHT TEXT AREA
        function autoResize(textarea) {
            textarea.style.height = 'auto'; // Set ulang tinggi textarea ke nilai default
            textarea.style.height = (textarea.scrollHeight) + 'px'; // Atur tinggi textarea ke tinggi konten
        }
    
        // Fungsi untuk menghitung waktu yang sudah berlalu dan memperbarui tampilan
        function updateElapsedTime() {
            @foreach ($albums as $album)
            @if($album)
                // Mendapatkan waktu album dibuat dari server
                var createdAt{{ $album->id }} = new Date(document.getElementById('createdAt{{ $album->id }}').innerText);
                
                // Mendapatkan waktu sekarang
                var now = new Date();
    
                // Menghitung selisih waktu dalam milidetik
                var elapsedMilliseconds{{ $album->id }} = now - createdAt{{ $album->id }};
    
                // Menghitung selisih waktu dalam detik
                var elapsedSeconds{{ $album->id }} = Math.floor(elapsedMilliseconds{{ $album->id }} / 1000);
    
                // Variabel untuk menyimpan waktu yang sudah berlalu
                var timeElapsed{{ $album->id }};
    
                // Mengupdate tampilan dengan waktu yang sudah berlalu sesuai kondisi
                if (elapsedSeconds{{ $album->id }} < 60) {
                    // Menampilkan waktu dalam detik jika kurang dari 1 menit
                    timeElapsed{{ $album->id }} = elapsedSeconds{{ $album->id }} + ' seconds ago';
                } else if (elapsedSeconds{{ $album->id }} < 3600) {
                    // Menampilkan waktu dalam menit jika kurang dari 1 jam
                    var elapsedMinutes{{ $album->id }} = Math.floor(elapsedSeconds{{ $album->id }} / 60);
                    timeElapsed{{ $album->id }} = elapsedMinutes{{ $album->id }} + ' minutes ago';
                } else if (elapsedSeconds{{ $album->id }} < 86400) {
                    // Menampilkan waktu dalam jam jika kurang dari 1 hari
                    var elapsedHours{{ $album->id }} = Math.floor(elapsedSeconds{{ $album->id }} / 3600);
                    timeElapsed{{ $album->id }} = elapsedHours{{ $album->id }} + ' hours ago';
                } else if (elapsedSeconds{{ $album->id }} < 2592000) {
                    // Menampilkan waktu dalam hari jika kurang dari 30 hari (1 bulan)
                    var elapsedDays{{ $album->id }} = Math.floor(elapsedSeconds{{ $album->id }} / 86400);
                    timeElapsed{{ $album->id }} = elapsedDays{{ $album->id }} + ' days ago';
                } else {
                    // Menampilkan tanggal jika lebih dari 1 bulan
                    var day{{ $album->id }} = createdAt{{ $album->id }}.getDate();
                    var month{{ $album->id }} = createdAt{{ $album->id }}.getMonth() + 1;
                    var year{{ $album->id }} = createdAt{{ $album->id }}.getFullYear();
                    timeElapsed{{ $album->id }} = day{{ $album->id }} + '-' + month{{ $album->id }} + '-' + year{{ $album->id }};
                }
    
                // Mengupdate tampilan dengan waktu yang sudah berlalu
                document.getElementById('timeElapsed{{ $album->id }}').innerText = timeElapsed{{ $album->id }};
            @endif
            @endforeach
        }
    
        // Memperbarui waktu yang sudah berlalu setiap detik
        setInterval(updateElapsedTime, 1000);
    
        // Memanggil fungsi updateElapsedTime() untuk pertama kali
        updateElapsedTime();
    </script>
</body>
</html>