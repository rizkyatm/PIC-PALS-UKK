<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Category;
use App\Models\Foto;
use App\Models\User;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function search(Request $request)
    {
        // Ambil data yang dikirimkan oleh form
        $searchType = $request->input('type');
        $keyword = $request->input('keyword');

        // Inisialisasi query builder
        $query = Foto::query();

        // Tambahkan kondisi berdasarkan pilihan searchType
        if ($searchType === 'Users') {
            // Jika pencarian berdasarkan user_id
            $query->whereHas('user', function ($query) use ($keyword) {
                $query->where('username', 'like', "%$keyword%");
            });
        } elseif ($searchType === 'Category') {
            // Jika pencarian berdasarkan kategori_id
            $query->whereHas('category', function ($query) use ($keyword) {
                $query->where('judul_kategori', 'like', "%$keyword%");
            });
        } elseif ($searchType === 'Images') {
            // Jika pencarian berdasarkan judul foto
            $query->where('judul_foto', 'like', "%$keyword%");
        }

        // Lakukan query untuk mendapatkan hasil pencarian
        $fotos = $query->get();

        $userId = auth()->id(); 
        $user = User::find($userId);
        $categorys = Category::cursor();
        $albums = Album::where('user_id', $userId)->latest()->get();

        // Kirim data hasil pencarian ke view
        return view('user.search_results', compact('fotos', 'user', 'categorys','albums','keyword','searchType'));
    }
}
