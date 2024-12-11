@extends('layouts.app')
@section('content')
    <div class="row g-4">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                {{ session('status') }} successfully
            </div>
        @endif
        {{-- Update Profile Information --}}
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('Update Profile Information') }}</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
        {{-- Update Password --}}
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('Update Password') }}</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
        {{-- Delete Account --}}
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('Delete Account') }}</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
