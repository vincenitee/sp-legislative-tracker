@extends('layouts.app')

@section('title', 'Public Legislative Search')

@section('content')
<!-- Hero / Search Banner -->
<div class="card border-0 shadow-sm mb-4 bg-white">
    <div class="card-body p-4 p-md-5">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <span class="badge bg-primary-subtle text-primary mb-2 px-3 py-2">
                    <i class="bi bi-globe2 me-1"></i> Public Legislative Portal (View-Only Access)
                </span>
                <h2 class="fw-bold mb-2">Search Provincial Ordinances &amp; Resolutions</h2>
                <p class="text-muted mb-4">
                    Search official legislative records of the Sangguniang Panlalawigan by title keywords (e.g., <code>environment</code> or <code>agricultur</code>) or record number.
                </p>

                <form action="{{ route('public.search') }}" method="GET" class="row g-3">
                    <div class="col-md-5">
                        <label for="keyword" class="form-label fw-semibold small">Title Keyword (Exact or Partial)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                            <input type="text" name="keyword" id="keyword" class="form-control"
                                   placeholder="Search title keywords (e.g. agricultur, environment)..."
                                   value="{{ $keyword }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="type" class="form-label fw-semibold small">Record Type</label>
                        <select name="type" id="type" class="form-select">
                            <option value="all" {{ $type === 'all' ? 'selected' : '' }}>All Records (Ordinances &amp; Resolutions)</option>
                            <option value="ordinance" {{ $type === 'ordinance' ? 'selected' : '' }}>Provincial Ordinances Only</option>
                            <option value="resolution" {{ $type === 'resolution' ? 'selected' : '' }}>Provincial Resolutions Only</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label for="number" class="form-label fw-semibold small">Record No. (Optional)</label>
                        <input type="text" name="number" id="number" class="form-control"
                               placeholder="e.g. PO-2026" value="{{ $number }}">
                    </div>

                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Search
                        </button>
                        @if($keyword !== '' || $type !== 'all' || $number !== '')
                            <a href="{{ route('public.search') }}" class="btn btn-outline-secondary" title="Clear Search">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Search Results Table -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0 fw-bold">
        Legislative Records
        <span class="badge bg-secondary ms-1">{{ $results->count() }} {{ Str::plural('result', $results->count()) }}</span>
    </h5>
    @if($keyword !== '')
        <span class="text-muted small">Showing matches for keyword: <strong>"{{ $keyword }}"</strong></span>
    @endif
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 14%;">Record Type</th>
                    <th style="width: 15%;">Record Number</th>
                    <th style="width: 41%;">Title / Subject</th>
                    <th style="width: 13%;">Date Passed</th>
                    <th style="width: 10%;">Author / Sponsor</th>
                    <th class="text-end" style="width: 7%;">Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse($results as $item)
                    <tr>
                        <td>
                            @if($item['record_type'] === 'Ordinance')
                                <span class="badge bg-primary">
                                    <i class="bi bi-journal-bookmark-fill me-1"></i> Ordinance
                                </span>
                            @else
                                <span class="badge bg-info text-dark">
                                    <i class="bi bi-file-earmark-text-fill me-1"></i> Resolution
                                </span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $item['number'] }}</td>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['date_passed']->format('M d, Y') }}</td>
                        <td>{{ $item['author_sponsor'] }}</td>
                        <td class="text-end">
                            <a href="{{ $item['url'] }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i> View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-search fs-3 d-block mb-2"></i>
                            No matching legislative records found. Try another keyword.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection