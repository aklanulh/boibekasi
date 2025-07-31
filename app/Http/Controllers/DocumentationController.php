<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentation;

class DocumentationController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data dokumentasi dari database
        $query = Documentation::where('status', 'active')
                             ->orderBy('date', 'desc');
        
        // Filter berdasarkan tipe event jika ada
        if ($request->has('type') && $request->type != 'all') {
            $query->where('type', $request->type);
        }
        
        // Filter berdasarkan tahun jika ada
        if ($request->has('year') && $request->year != 'all') {
            $query->whereYear('date', $request->year);
        }
        
        $documentations = $query->get();
        
        // Ambil daftar tipe event yang unik dari database
        $eventTypes = Documentation::where('status', 'active')
                                  ->distinct()
                                  ->pluck('type')
                                  ->filter()
                                  ->sort()
                                  ->values()
                                  ->toArray();
        
        // Ambil daftar tahun yang unik dari database
        $years = Documentation::where('status', 'active')
                             ->selectRaw('YEAR(date) as year')
                             ->distinct()
                             ->orderBy('year', 'desc')
                             ->pluck('year')
                             ->toArray();
        
        return view('documentation', compact('documentations', 'eventTypes', 'years'));
    }
}
