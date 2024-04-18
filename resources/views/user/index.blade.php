@extends('user.layoutMaster.master')

@section('title', 'Home - Pic Pals')

@section('content')
    <section class="mt-4 mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="card-columns">
                    @foreach ($fotos as $foto)
                        @if($foto)
                        {{-- <div href="" data-toggle="modal" data-target="#imageModal_{{ $foto->id }}" onclick="openModal({{ $foto->id }})"> --}}
                            <div class="gambar-utama card card-pin">
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
                                                <a style="padding-right: 5px">
                                                    <span style="color: white; font-size: 12px">
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
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection