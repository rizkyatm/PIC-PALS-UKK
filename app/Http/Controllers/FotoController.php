<?php

namespace App\Http\Controllers;

use App\Models\AktivitasUser;
use App\Models\Album;
use App\Models\Category;
use App\Models\Foto;
use App\Models\Jenislaporan;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FotoController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); 
        $user = User::find($userId);
        $categorys = Category::cursor();
        $albums = Album::where('user_id', $userId)->latest()->get();
        $jenisPelanggaran = Jenislaporan::all();

        $fotoTerbaru = Foto::with('album','category')->latest()->first();
        $fotosTanpaTerbaru = Foto::with('album','category')->where('id', '!=', optional($fotoTerbaru)->id)->get();
        $fotos = collect([$fotoTerbaru])->merge($fotosTanpaTerbaru->shuffle());        

        return view('user.index', compact('fotos','albums','user','categorys','jenisPelanggaran'));
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
        $photo->kategori_id = $request->kategori;
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

        $aktivitas = "Menambahkan foto baru dengan judul " . $validatedData['judul_foto'];

        // Simpan aktivitas ke tabel aktivitas_user
        AktivitasUser::create([
            'user_id' => Auth::id(),
            'aktivitas' => $aktivitas,
            'foto' => $lokasi_file
        ]);
    
        // Redirect atau tampilkan respons sesuai kebutuhan aplikasi Anda
        return response()->json(['message' => 'Foto berhasil ditambahkan!']);
    }

    public function deleteFoto($id)
    {
        if(request()->ajax()) {
            $foto = Foto::findOrFail($id);
            
            if ($foto->user->id == auth()->id()) {
                $aktivitas = "Menghapus foto dengan judul " . $foto['judul_foto'];

                // Simpan aktivitas ke tabel aktivitas_user
                AktivitasUser::create([
                    'user_id' => Auth::id(),
                    'aktivitas' => $aktivitas,
                    'foto' => "public/".$foto['lokasi_file']
                ]);
                
                $foto->delete();
                return response()->json(['success' => true, 'message' => 'Photo deleted successfully.']);
            } else {
                return response()->json(['error' => false, 'message' => 'You do not have permission to delete this photo.']);
            }
        }
    }

    public function profile($id)
    {
        $user = User::find($id);
        
        // Menghitung total postingan pengguna
        $fotos = Foto::where('user_id', $id)->latest()->get();
        $totalPost = $fotos->count();

        $userId = auth()->id(); 
        $albums = Album::where('user_id', $userId)->latest()->get();


        // Menghitung total like pengguna
        $totalLike = Like::whereIn('foto_id', $fotos->pluck('id'))->count();

        // Menghitung jumlah album pengguna
        $albums = Album::where('user_id', $id)->latest()->get();
        $totalAlbum = $albums->count();

        $categorys = Category::all();

        return view('user.profile', compact('fotos','albums','totalPost', 'totalLike', 'totalAlbum','user', 'categorys'));
    }

    public function updateFoto(Request $request, $id)
    {
        // Validasi data yang dikirimkan
        $validatedData = $request->validate([
            'judul_foto' => 'required',
            'deskripsi_foto' => 'required',
            'kategori' => 'required|exists:categories,id', // Pastikan kategori yang dipilih ada dalam database
            'album' => 'nullable|exists:albums,id', // Opsional: pastikan album yang dipilih ada dalam database jika ada
        ]);

        // Temukan foto yang akan diedit
        $photo = Foto::findOrFail($id);

        // Update informasi foto
        $photo->judul_foto = $validatedData['judul_foto'];
        $photo->deskripsi_foto = $validatedData['deskripsi_foto'];
        $photo->kategori_id = $validatedData['kategori'];

        // Jika album baru dipilih atau tidak dipilih, update album_id
        if ($request->filled('album')) {
            $photo->album_id = $validatedData['album'];
        } else {
            $photo->album_id = null; // Kosongkan album_id jika album tidak dipilih
        }

        // Simpan perubahan
        $photo->save();

        // Simpan informasi foto sebelum diperbarui
        // $fotoSebelumnya = $photo->toArray();
        // // Buat aktivitas pengguna
        // $aktivitas = "Mengupdate foto dengan judul " . $fotoSebelumnya['judul_foto'];

        // // Simpan aktivitas ke tabel aktivitas_user
        // AktivitasUser::create([
        //     'user_id' => auth()->id(),
        //     'aktivitas' => $aktivitas,
        //     'foto' => "public/" .$fotoSebelumnya['lokasi_file']
        // ]);
        

        // Kirim respons JSON untuk Ajax
        return response()->json(['message' => 'Foto berhasil diperbarui!']);
    }
}
