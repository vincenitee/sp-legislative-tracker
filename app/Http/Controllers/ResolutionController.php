<?php

namespace App\Http\Controllers;

use App\Models\Resolution;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Resolution::query();
        // Filter by Resolution Number
        if ($request->filled('resolution_number')) {
            $query->where('resolution_number', 'like', '%' . trim($request->resolution_number) . '%');
        }
        // Filter by Title (partial keyword matching)
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . trim($request->title) . '%');
        }
        // Filter by Date Passed
        if ($request->filled('date_passed')) {
            $query->whereDate('date_passed', $request->date_passed);
        }
        $resolutions = $query->orderByDesc('date_passed')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();
        return view('admin.resolutions.index', compact('resolutions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.resolutions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'resolution_number' => ['required', 'string', 'max:100', 'unique:resolutions,resolution_number'],
            'title'             => ['required', 'string', 'max:500'],
            'date_passed'       => ['required', 'date'],
            'author_sponsor'    => ['required', 'string', 'max:255'],
            'description'       => ['nullable', 'string'],
            'status'            => ['required', 'string', Rule::in(['adopted', 'archived'])],
        ]);

        Resolution::create($validated);
        
        return redirect()->route('admin.resolutions.index')
            ->with('success', 'Provincial Resolution created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resolution $resolution)
    {
        return view('admin.resolutions.show', compact('resolution'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resolution $resolution)
    {
        return view('admin.resolutions.edit', compact('resolution'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resolution $resolution)
    {
        $validated = $request->validate([
            'resolution_number' => [
                'required',
                'string',
                'max:100',
                Rule::unique('resolutions', 'resolution_number')->ignore($resolution->id),
            ],
            'title'          => ['required', 'string', 'max:500'],
            'date_passed'    => ['required', 'date'],
            'author_sponsor' => ['required', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],
            'status'         => ['required', 'string', Rule::in(['adopted', 'archived'])],
        ]);

        $resolution->update($validated);
        
        return redirect()->route('admin.resolutions.index')
            ->with('success', 'Provincial Resolution updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resolution $resolution)
    {
        $resolution->delete();
        return redirect()->route('admin.resolutions.index')
            ->with('success', 'Provincial Resolution deleted successfully.');
    }
}
