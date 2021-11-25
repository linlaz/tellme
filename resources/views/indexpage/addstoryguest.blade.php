<div>
    <form action="{{ route('storestoryguest') }}" method="POST">
        @csrf
        <select class="form-select" wire:model='choice' name="choice">
            <option value="text">Text</option>
            <option value="voice">Voice</option>
        </select>
        @if ($choice == 'text')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">tellme</h5>
                    <input id="story" type="hidden" name="story" required>
                    <trix-editor input="story"></trix-editor>
                </div>
            </div>
        @else
            {{ 'asu' }}
        @endif

        @auth
            <a href="{{ route('registers') }}" class="btn btn-secondary mt-2">buat akun</a>
        @endauth
        <button type="submit" class="btn btn-primary mt-2">add story</button>
    </form>
</div>
