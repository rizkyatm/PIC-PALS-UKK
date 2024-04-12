<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FotoController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); 
        $albums = Album::where('user_id', $userId)->latest()->get();

        $fotoTerbaru = Foto::latest()->first();
        $fotosTanpaTerbaru = Foto::where('id', '!=', optional($fotoTerbaru)->id)->get();
        $fotos = collect([$fotoTerbaru])->merge($fotosTanpaTerbaru->shuffle());

        return view('user.index', compact('fotos','albums'));
    }

    public function storeFoto(Request $request)
    {
        // Validasi data yang dikirimkan
        $validatedData = $request->validate([
            'judul_foto' => 'required',
            'deskripsi_foto' => 'required',
            'lokasi_file' => 'required|image|mimes:jpeg,png,jpg,gif', // Sesuaikan dengan kebutuhan Anda
        ]);
    
        $user = Auth::user();
        $fileName = $user->username . '_' . now()->format('Ymd_His') . '.' . $request->file('lokasi_file')->getClientOriginalExtension();
        $lokasi_file = $request->file('lokasi_file')->storeAs('public/photos', $fileName);
    
        $photo = new Foto();
        $photo->judul_foto = $validatedData['judul_foto'];
        $photo->deskripsi_foto = $validatedData['deskripsi_foto'];
        $photo->lokasi_file = str_replace('public/', '', $lokasi_file);
        $photo->user_id = Auth::id();
    
        // Jika album baru dipilih, simpan informasi album baru
        if ($request->filled('new_album')) {
            $album = new Album();
            $album->nama_album = $request->new_album;
            $album->user_id = Auth::id();
            $album->save();
    
            $photo->album_id = $album->id;
        } elseif ($request->filled('album')) {
            $photo->album_id = $request->album;
        }
    
        $photo->save();
    
        // Redirect atau tampilkan respons sesuai kebutuhan aplikasi Anda
        return response()->json(['message' => 'Foto berhasil ditambahkan!']);
    }

    public function deleteFoto($id)
    {
        if(request()->ajax()) {
            $foto = Foto::findOrFail($id);
            
            if ($foto->user->id == auth()->id()) {
                $foto->delete();
                return response()->json(['success' => true, 'message' => 'Photo deleted successfully.']);
            } else {
                return response()->json(['error' => false, 'message' => 'You do not have permission to delete this photo.']);
            }
        }
    }
}
