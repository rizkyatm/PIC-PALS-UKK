@extends('user.layoutMaster.master')

@section('title', 'Search - Pic Pals')

@section('content')
    <section class="mt-4 mb-5">
        <div class="container-fluid">
            <div style="margin-bottom: 20px">
                <span style="font-size: 20px;">Search results for  '<span style="color: #132B40; font-style: italic;">{{$keyword}}</span>'</span>
            </div>
                <div class="card-columns">  
                    @if($fotos->isEmpty())
                        <div class="alert alert-warning" style="width: 94vw" role="alert"> 
                            The photo you are looking for could not be found
                        </div>
                    @else
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
                            @endif
                        @endforeach
                    @endif
                </div>
        </div>
    </section>
@endsection


