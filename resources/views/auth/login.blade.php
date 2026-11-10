@extends('layouts.app')

@section('title', 'Administrator Login')

@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Administrator Login</h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted small mb-4">
                        Sign in with an authorized account to manage Provincial Ordinances and Resolutions.
                    </p>

                    <form action="{{ route('login.submit') }}" method="POST" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address <span
                                    class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="admin@launion.gov.ph"
                                required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password <span
                                    class="text-danger">*</span></label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light text-center py-3 small">
                    Looking for public records? <a href="{{ route('public.search') }}" class="fw-semibold">Go to Public
                        Legislative Search</a>
                </div>
            </div>
        </div>
    </div>
@endsection
