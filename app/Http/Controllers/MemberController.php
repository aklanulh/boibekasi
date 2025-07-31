<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data member aktif dari database
        $query = Member::where('status', 'active')
                      ->orderBy('join_date', 'desc');
        
        // Filter berdasarkan jenis motor jika ada
        if ($request->has('bike_type') && $request->bike_type != 'Semua Motor') {
            $query->where('bike_type', $request->bike_type);
        }
        
        $members = $query->get();
        
        // Ambil daftar jenis motor yang unik dari database
        $bikeTypes = ['Semua Motor'] + Member::where('status', 'active')
                                           ->distinct()
                                           ->pluck('bike_type')
                                           ->filter()
                                           ->sort()
                                           ->values()
                                           ->toArray();
        
        return view('members', compact('members', 'bikeTypes'));
    }
}
