@extends('layouts.app')

@section('title', 'Ordinance Details - ' . $ordinance->ordinance_number)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 fw-bold">Ordinance Details</h3>
            <a href="{{ route('admin.ordinances.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Back to List
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <div>
                    <span class="badge bg-primary me-2">PROVINCIAL ORDINANCE</span>
                    <span class="fw-bold fs-5">{{ $ordinance->ordinance_number }}</span>
                </div>
                <span class="badge {{ strtolower($ordinance->status) === 'active' ? 'bg-success' : 'bg-secondary' }} fs-6">
                    {{ $ordinance->status }}
                </span>
            </div>
            <div class="card-body p-4">
                <h4 class="fw-bold mb-4">{{ $ordinance->title }}</h4>

                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded">
                            <div class="text-muted small text-uppercase fw-semibold">Date Passed</div>
                            <div class="fs-6 fw-semibold mt-1">
                                <i class="bi bi-calendar-event me-1 text-primary"></i>
                                {{ $ordinance->date_passed->format('F d, Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded">
                            <div class="text-muted small text-uppercase fw-semibold">Author / Sponsor</div>
                            <div class="fs-6 fw-semibold mt-1">
                                <i class="bi bi-person-badge me-1 text-primary"></i>
                                {{ $ordinance->author_sponsor }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted text-uppercase small fw-bold">Summary / Remarks</h6>
                    <p class="mb-0">{{ $ordinance->description ?: 'No additional summary provided.' }}</p>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Last updated: {{ $ordinance->updated_at->format('M d, Y h:i A') }}
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.ordinances.edit', $ordinance) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil me-1"></i> Edit Ordinance
                        </a>
                        <form action="{{ route('admin.ordinances.destroy', $ordinance) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete Ordinance {{ $ordinance->ordinance_number }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection