<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Merchandise;
use App\Models\Event;
use App\Models\Documentation;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_members' => Member::count(),
            'active_members' => Member::where('status', 'active')->count(),
            'total_merchandise' => Merchandise::count(),
            'available_merchandise' => Merchandise::where('status', 'available')->count(),
            'total_events' => Event::count(),
            'upcoming_events' => Event::where('status', 'upcoming')->count(),
            'total_documentation' => Documentation::count(),
            'published_documentation' => Documentation::where('status', 'published')->count(),
        ];
        
        $recent_members = Member::latest()->take(5)->get();
        $upcoming_events = Event::where('status', 'upcoming')
                                ->orderBy('date', 'asc')
                                ->take(5)
                                ->get();
        $recent_documentation = Documentation::where('status', 'published')
                                           ->latest()
                                           ->take(5)
                                           ->get();
        
        return view('admin.dashboard', compact('stats', 'recent_members', 'upcoming_events', 'recent_documentation'));
    }
}
