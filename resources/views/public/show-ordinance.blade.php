@extends('layouts.app')

@section('title', $ordinance->ordinance_number . ' - Provincial Ordinance')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted small">
                    <i class="bi bi-eye me-1"></i> Public View-Only Record
                </span>
                <a href="{{ route('public.search') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Public Search
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="badge bg-light text-primary me-2">PROVINCIAL ORDINANCE</span>
                        <span class="fw-bold fs-5">{{ $ordinance->ordinance_number }}</span>
                    </div>
                    <span class="badge bg-light text-dark">{{ $ordinance->status }}</span>
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

                    <div>
                        <h6 class="text-muted text-uppercase small fw-bold">Summary / Remarks</h6>
                        <p class="mb-0">{{ $ordinance->description ?: 'No additional summary provided.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
