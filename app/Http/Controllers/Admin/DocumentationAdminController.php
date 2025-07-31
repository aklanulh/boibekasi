<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentationAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documentations = Documentation::with('event')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.documentation.index', compact('documentations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::where('status', 'published')->orderBy('date', 'desc')->get();
        return view('admin.documentation.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:photo,video',
            'date' => 'required|date',
            'event_id' => 'nullable|exists:events,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
            'photographer' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published,archived'
        ]);

        $data = $request->all();
        $data['views'] = 0;
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('documentation', 'public');
            $data['image'] = $imagePath;
        }

        Documentation::create($data);

        return redirect()->route('admin.documentation.index')
                        ->with('success', 'Dokumentasi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $documentation = Documentation::with('event')->findOrFail($id);
        return view('admin.documentation.show', compact('documentation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $documentation = Documentation::findOrFail($id);
        $events = Event::where('status', 'published')->orderBy('date', 'desc')->get();
        return view('admin.documentation.edit', compact('documentation', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $documentation = Documentation::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:photo,video',
            'date' => 'required|date',
            'event_id' => 'nullable|exists:events,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
            'photographer' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published,archived'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($documentation->image) {
                Storage::disk('public')->delete($documentation->image);
            }
            $imagePath = $request->file('image')->store('documentation', 'public');
            $data['image'] = $imagePath;
        }

        $documentation->update($data);

        return redirect()->route('admin.documentation.index')
                        ->with('success', 'Dokumentasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $documentation = Documentation::findOrFail($id);
        
        // Delete image file
        if ($documentation->image) {
            Storage::disk('public')->delete($documentation->image);
        }
        
        $documentation->delete();

        return redirect()->route('admin.documentation.index')
                        ->with('success', 'Dokumentasi berhasil dihapus!');
    }
}
