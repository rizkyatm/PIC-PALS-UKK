<?php

namespace App\Http\Controllers;

use App\Models\AktivitasUser;
use App\Models\Foto;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Request $request)
    {
        $userId = Auth::id();
        $photoId = $request->input('foto_id');

        // Check if the user has already liked the photo
        $like = Like::where('user_id', $userId)
                    ->where('foto_id', $photoId)
                    ->first();

        if ($like) {
            // If the user has already liked the photo, unlike it
            $like->delete();
            $message = 'Photo unliked successfully';
            $action = 'unliked';
        } else {
            // If the user has not liked the photo, like it
            $like = new Like();
            $like->user_id = $userId;
            $like->foto_id = $photoId;
            $like->save();
            $message = 'Photo liked successfully';
            $action = 'liked';
        }

        // You can also return the updated like count if needed
        $likeCount = Like::where('foto_id', $photoId)->count();


        ///////////////////////////////////////////////////////////
        // Ambil data foto terkait
        $foto = Foto::findOrFail($photoId);

        // Buat pesan aktivitas berdasarkan tindakan yang dilakukan
        $aktivitas = ($action === 'liked' ? 'Menyukai' : 'Me-unlike') . ' salah satu postingan ' . $foto->user->username;

        // Simpan aktivitas ke tabel aktivitas_user
        AktivitasUser::create([
            'user_id' => $userId,
            'aktivitas' => $aktivitas,
            'foto' => "public/".$foto->lokasi_file,
        ]);
        /////////////////////////////////////////////////////////////

        return response()->json([
            'message' => $message,
            'action' => $action,
            'like_count' => $likeCount,
        ]);
    }

    public function getLikeStatus(Request $request)
    {
        $photoId = $request->input('foto_id');
        $userLiked = false;
        $likeCount = Like::where('foto_id', $photoId)->count();
    
        // Periksa apakah pengguna sudah memberikan like pada foto tertentu
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $userLiked = Like::where('foto_id', $photoId)->where('user_id', $userId)->exists();
        }
    
        return response()->json([
            'user_liked' => $userLiked,
            'like_count' => $likeCount
        ]);
    }
}
