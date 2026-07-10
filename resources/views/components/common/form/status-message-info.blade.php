<div class="status-message-info-container">
    @error('error')
    <div class="status-error-message">
        <p>{{ $message }}</p>
    </div>
    @enderror
    @if (session('status'))
    <div class="status-status-message">
        <p>{{ session('status') }}</p>
    </div>
    @endif
    @if (session('success'))
    <div class="status-success-message">
        <p>{{ session('success') }}</p>
    </div>
    @endif
</div>