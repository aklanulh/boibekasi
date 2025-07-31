<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;

class MemberAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'nrp' => 'nullable|string|max:20|unique:members,nrp',
            'phone' => 'nullable|string|max:20',
            'bike_type' => 'required|string|max:255',
            'bike_year' => 'nullable|string|max:4',
            'bike_color' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'join_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'address' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        $data = $request->only([
            'name', 'email', 'nrp', 'phone', 'bike_type', 'bike_year', 'bike_color',
            'join_date', 'status', 'address', 'notes'
        ]);
        
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('members', 'public');
        }

        Member::create($data);

        return redirect()->route('admin.members.index')
                        ->with('success', 'Member berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('admin.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,
            'nrp' => 'nullable|string|max:20|unique:members,nrp,' . $member->id,
            'phone' => 'nullable|string|max:20',
            'bike_type' => 'required|string|max:255',
            'bike_year' => 'nullable|string|max:4',
            'bike_color' => 'nullable|string|max:50',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'join_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'address' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        $data = $request->only([
            'name', 'email', 'nrp', 'phone', 'bike_type', 'bike_year', 'bike_color',
            'join_date', 'status', 'address', 'notes'
        ]);
        
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($member->photo && Storage::disk('public')->exists($member->photo)) {
                Storage::disk('public')->delete($member->photo);
            }
            $data['photo'] = $request->file('photo')->store('members', 'public');
        }

        $member->update($data);

        return redirect()->route('admin.members.index')
                        ->with('success', 'Member berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        // Delete photo if exists
        if ($member->photo && Storage::disk('public')->exists($member->photo)) {
            Storage::disk('public')->delete($member->photo);
        }
        
        $member->delete();

        return redirect()->route('admin.members.index')
                        ->with('success', 'Member berhasil dihapus.');
    }
}
