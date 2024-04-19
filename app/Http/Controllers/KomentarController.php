<?php

namespace App\Http\Controllers;

use App\Models\AktivitasUser;
use App\Models\Foto;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        // Simpan data komentar ke database
        $comment = new Komentar();
        $comment->isi_komentar = $request->isi_komentar;
        $comment->user_id = Auth::id();
        $comment->foto_id = $request->foto_id;
        $comment->save();

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        // Ambil data foto terkait
        $foto = Foto::findOrFail($request->foto_id);

        // Ambil username pemilik foto
        $ownerUsername = $foto->user->username;
        $ownerFoto = $foto->lokasi_file;

        // Buat aktivitas pengguna dengan menyertakan username pemilik foto
        $aktivitas = "Mengirim komentar pada salah satu postingan milik @" . $ownerUsername;

        // Simpan aktivitas ke tabel aktivitas_user
        AktivitasUser::create([
            'user_id' => auth()->id(),
            'aktivitas' => $aktivitas,
            'foto' => $ownerFoto
        ]);
        /////////////////////////////////////////////////////////////////////////////////////////////////////

        // Redirect atau tampilkan respons sesuai kebutuhan aplikasi Anda
        return response()->json(['message' => 'Komentar berhasil ditambahkan!', 'foto_id' => $request->foto_id]);
    }

    public function getComment($id) {
        // $comments = Komentar::where('foto_id', $id)->orderBy('created_at', 'desc')->get();
        $comments = Komentar::where('foto_id', $id)->with('user')->orderBy('created_at', 'desc')->get();
        return response()->json(['comments' => $comments]);

        // return view('comments.index', compact('comments'));
    }
}
