<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Event;
use App\Models\Documentation;
use App\Models\Merchandise;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil statistik untuk homepage
        $stats = [
            'total_members' => Member::where('status', 'active')->count(),
            'upcoming_events' => Event::where('status', 'active')
                                    ->where('date', '>=', now())
                                    ->count(),
            'total_documentation' => Documentation::where('status', 'active')->count(),
            'available_merchandise' => Merchandise::where('status', 'active')->count()
        ];
        
        // Ambil event terdekat
        $upcomingEvents = Event::where('status', 'active')
                              ->where('date', '>=', now())
                              ->orderBy('date', 'asc')
                              ->limit(3)
                              ->get();
        
        // Ambil dokumentasi terbaru
        $recentDocumentations = Documentation::where('status', 'active')
                                            ->orderBy('date', 'desc')
                                            ->limit(6)
                                            ->get();
        
        // Ambil member terbaru
        $recentMembers = Member::where('status', 'active')
                              ->orderBy('join_date', 'desc')
                              ->limit(8)
                              ->get();
        
        return view('home', compact('stats', 'upcomingEvents', 'recentDocumentations', 'recentMembers'));
    }
}
