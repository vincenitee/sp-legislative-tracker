@extends('layouts.app')

@section('title', 'Add New Ordinance')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="mb-0 fw-bold">Create Provincial Ordinance</h3>
                <a href="{{ route('admin.ordinances.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('admin.ordinances.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="ordinance_number" class="form-label fw-semibold">Ordinance Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="ordinance_number" id="ordinance_number"
                                    class="form-control @error('ordinance_number') is-invalid @enderror"
                                    placeholder="e.g. PO-2026-004" value="{{ old('ordinance_number') }}" required>
                                @error('ordinance_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="date_passed" class="form-label fw-semibold">Date Passed <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="date_passed" id="date_passed"
                                    class="form-control @error('date_passed') is-invalid @enderror"
                                    value="{{ old('date_passed') }}" required>
                                @error('date_passed')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="title" class="form-label fw-semibold">Title / Subject <span
                                        class="text-danger">*</span></label>
                                <textarea name="title" id="title" rows="2" class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Enter the full official title of the ordinance..." required>{{ old('title') }}</textarea>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-8">
                                <label for="author_sponsor" class="form-label fw-semibold">Author / Sponsor <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="author_sponsor" id="author_sponsor"
                                    class="form-control @error('author_sponsor') is-invalid @enderror"
                                    placeholder="e.g. Hon. Maria Cruz" value="{{ old('author_sponsor') }}" required>
                                @error('author_sponsor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="status" class="form-label fw-semibold">Status <span
                                        class="text-danger">*</span></label>
                                <select name="status" id="status"
                                    class="form-select @error('status') is-invalid @enderror">
                                    @foreach (['active', 'amended', 'repealed'] as $statusOption)
                                        <option value="{{ $statusOption }}"
                                            {{ strtolower(old('status', 'active')) === $statusOption ? 'selected' : '' }}>
                                            {{ $statusOption }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label fw-semibold">Summary / Remarks <span
                                        class="text-muted fw-normal">(Optional)</span></label>
                                <textarea name="description" id="description" rows="4"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Brief summary or additional remarks about this ordinance...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.ordinances.index') }}" class="btn btn-light border">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i> Save Ordinance
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
