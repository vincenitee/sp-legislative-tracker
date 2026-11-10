<?php

namespace App\Http\Controllers;

use App\Models\Ordinance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrdinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ordinance::query();

        // Filter by ordinance number   
        if($request->filled('ordinance_number')) {
            $ordinance_no = trim($request->ordinance_number);
            $query->where('ordinance_number', 'like', '%' . $ordinance_no . '%');
        }
            
        // Filter by title
        if($request->filled('title')) {
            $title = trim($request->title);
            $query->where('title', 'like', '%' . $title . '%');
        }

        // Filter by date passed (exact date)
        if($request->filled('date_passed')) {
            $query->whereDate('date_passed', $request->date_passed);
        }

        $ordinances = $query->orderByDesc('date_passed')
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.ordinances.index', compact('ordinances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ordinances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate data
        $validated = $request->validate([
           'ordinance_number' => ['required', 'string', 'max:100', 'unique:ordinances,ordinance_number'],
           'title' => ['required', 'string', 'max:500'],
           'date_passed' => ['required', 'date'],
           'author_sponsor' => ['required', 'string', 'max:255'],
           'description' => ['nullable', 'string'],
           'status' => ['required', 'string', Rule::in(['active', 'amended', 'repealed'])]
        ]);

        Ordinance::create($validated);

        return redirect()->route('admin.ordinances.index')->with('success', 'Provincial Ordinance created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ordinance $ordinance)
    {
        return view('admin.ordinances.show', compact('ordinance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ordinance $ordinance)
    {
        return view('admin.ordinances.edit', compact('ordinance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ordinance $ordinance)
    {   
        // Validate data
        $validate = $request->validate(['ordinance_number' => [
            'required',
            'string',
            'max:100',

            Rule::unique('ordinances', 'ordinance_number')->ignore($ordinance->id)
        ],
        'title' => ['required',  'string', 'max:500'],
        'date_passed' => ['required',  'date'],
        'author_sponsor' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'status' => ['required', 'string', Rule::in(['active', 'amended', 'repealed'])],
        ]);

        $ordinance->update($validate);

        return redirect()->route('admin.ordinances.index')->with('success', 'Provincial Ordinance updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ordinance $ordinance)
    {
        $ordinance->delete();

        return redirect()->route('admin.ordinances.index')->with('success', 'Provincial Ordinance deleted successfully.');
    }
}
