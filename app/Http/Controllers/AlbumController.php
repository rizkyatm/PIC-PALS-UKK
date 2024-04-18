<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Category;
use App\Models\Foto;
use App\Models\User;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function getAlbum($id)
    {   
        $user = User::find($id);
        $albums = Album::where('user_id', $id)->latest()->get();
        $categorys = Category::all();
        return view('user.album', compact('albums', 'user', 'categorys'));
    }

    public function create(Request $request)
    {
        // Buat album baru
        $album = new Album();
        $album->nama_album = $request->nama_album;
        $album->deskripsi = $request->deskripsi_album;
        // Set user_id sesuai dengan user yang sedang login
        $album->user_id = auth()->user()->id;
        $album->save();
    
        // Kirim respons JSON
        return response()->json(['message' => 'Album berhasil ditambahkan.', 'album_id' => $album->id]);
    }

    public function getFoto($id)
    {   
        $album = Album::find($id);
        $userId = $album->user_id; // Mendapatkan ID pengguna yang memiliki album ini
        $user = User::find($userId); // Mengambil pengguna berdasarkan ID pengguna
        $albums = Album::where('user_id', $id)->latest()->get();
        $fotos = Foto::where('album_id', $id)->latest()->get();
        $categorys = Category::all();
        return view('user.fotoAlbum', compact('fotos','album','user','albums','categorys'));
    }
}
