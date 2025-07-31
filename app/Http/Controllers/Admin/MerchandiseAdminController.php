<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MerchandiseAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merchandise = Merchandise::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.merchandise.index', compact('merchandise'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.merchandise.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sizes' => 'nullable|string',
            'colors' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('merchandise', 'public');
            $data['image'] = $imagePath;
        }

        Merchandise::create($data);

        return redirect()->route('admin.merchandise.index')
                        ->with('success', 'Merchandise berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $merchandise = Merchandise::findOrFail($id);
        return view('admin.merchandise.show', compact('merchandise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $merchandise = Merchandise::findOrFail($id);
        return view('admin.merchandise.edit', compact('merchandise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $merchandise = Merchandise::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sizes' => 'nullable|string',
            'colors' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        // Prepare data for update
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => $request->category,
            'stock' => $request->stock,
            'sizes' => $request->sizes,
            'colors' => $request->colors,
            'status' => $request->status
        ];
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            
            // Validate file
            if ($file->isValid()) {
                // Delete old image if exists
                if ($merchandise->image && Storage::disk('public')->exists($merchandise->image)) {
                    Storage::disk('public')->delete($merchandise->image);
                }
                
                // Store new image
                $imagePath = $file->store('merchandise', 'public');
                $data['image'] = $imagePath;
            }
        }

        // Update merchandise
        $merchandise->update($data);

        return redirect()->route('admin.merchandise.index')
                        ->with('success', 'Merchandise berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $merchandise = Merchandise::findOrFail($id);
        
        // Delete image file
        if ($merchandise->image) {
            Storage::disk('public')->delete($merchandise->image);
        }
        
        $merchandise->delete();

        return redirect()->route('admin.merchandise.index')
                        ->with('success', 'Merchandise berhasil dihapus!');
    }
}
