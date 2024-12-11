<form method="POST" action="{{ route('profile.destroy') }}">
    @csrf
    @method('DELETE')
    <p class="text-muted">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}</p>
    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input type="password" id="password" name="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" required>
        @error('password','userDeletion')
            <span class="text-danger small">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
</form>
