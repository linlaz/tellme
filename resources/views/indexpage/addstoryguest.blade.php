<div>
    <form action="{{ route('addstories') }}" method="POST">
        @csrf
        <select class="form-select" wire:model='pilihan' name="pilihan">
            <option value="text">Text</option>
            <option value="voice">Voice</option>
        </select>
        @if ($pilihan == 'text')
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">tellme</h5>
                     <trix-editor input="x"></trix-editor>
                </div>
            </div>
        @else
            {{ 'asu' }}
        @endif
        <button type="submit" class="btn btn-primary mt-2">add story</button>
    </form>
</div>