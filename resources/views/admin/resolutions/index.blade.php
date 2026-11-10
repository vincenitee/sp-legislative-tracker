@extends('layouts.app')

@section('title', 'Manage Provincial Resolutions')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0 fw-bold">Provincial Resolutions</h3>
            <p class="text-muted small mb-0">Manage, search, and filter official provincial resolutions.</p>
        </div>
        <a href="{{ route('admin.resolutions.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New Resolution
        </a>
    </div>

    <!-- Search & Filter Card -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.resolutions.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="resolution_number" class="form-label small fw-semibold">Resolution Number</label>
                    <input type="text" name="resolution_number" id="resolution_number" class="form-control"
                        placeholder="e.g. PR-2026-0101" value="{{ request('resolution_number') }}">
                </div>
                <div class="col-md-4">
                    <label for="title" class="form-label small fw-semibold">Title / Keyword</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="e.g. agriculture"
                        value="{{ request('title') }}">
                </div>
                <div class="col-md-3">
                    <label for="date_passed" class="form-label small fw-semibold">Date Passed</label>
                    <input type="date" name="date_passed" id="date_passed" class="form-control"
                        value="{{ request('date_passed') }}">
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-dark w-100">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                    @if (request()->anyFilled(['resolution_number', 'title', 'date_passed']))
                        <a href="{{ route('admin.resolutions.index') }}" class="btn btn-outline-secondary"
                            title="Reset Filters">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Resolutions Table -->
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 15%;">Resolution No.</th>
                        <th style="width: 38%;">Title</th>
                        <th style="width: 14%;">Date Passed</th>
                        <th style="width: 15%;">Author / Sponsor</th>
                        <th style="width: 8%;">Status</th>
                        <th class="text-end" style="width: 10%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($resolutions as $resolution)
                        <tr>
                            <td class="fw-bold text-primary">{{ $resolution->resolution_number }}</td>
                            <td>{{ $resolution->title }}</td>
                            <td>{{ $resolution->date_passed->format('M d, Y') }}</td>
                            <td>{{ $resolution->author_sponsor }}</td>
                            <td>
                                <span
                                    class="badge {{ strtolower($resolution->status) === 'adopted' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $resolution->status }}
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('admin.resolutions.show', $resolution) }}"
                                    class="btn btn-sm btn-outline-info" title="View Details">
                                    <i class="bi bi-eye"></i> View
                                </a>
                                <a href="{{ route('admin.resolutions.edit', $resolution) }}"
                                    class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.resolutions.destroy', $resolution) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete Resolution {{ $resolution->resolution_number }}? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                                No provincial resolutions found matching your criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($resolutions->hasPages())
            <div class="card-footer bg-white">
                {{ $resolutions->links() }}
            </div>
        @endif
    </div>
@endsection
