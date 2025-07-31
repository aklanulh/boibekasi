<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchandise;

class MerchandiseController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data merchandise dari database
        $query = Merchandise::where('status', 'active')
                           ->orderBy('created_at', 'desc');
        
        // Filter berdasarkan kategori jika ada
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }
        
        $merchandise = $query->get();
        
        // Ambil daftar kategori yang unik dari database
        $categories = Merchandise::where('status', 'active')
                                ->distinct()
                                ->pluck('category')
                                ->filter()
                                ->sort()
                                ->values()
                                ->toArray();
        
        return view('merchandise', compact('merchandise', 'categories'));
    }
}
