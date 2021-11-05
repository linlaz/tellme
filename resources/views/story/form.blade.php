<div>
    <form action="{{ route('addstories') }}" method="POST">
        @csrf
        <select class="form-select" wire:model='choice' name="choice">
        <option value="text">Text</option>
        <option value="voice">Voice</option>
        </select>
        @if ($choice == 'text')
        <div wire:ignore>
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Quill Editor Default</h5>
                <textarea class="form-control required tinymce-editor" name="story" id="mytextarea"></textarea>
                </div>
            </div>
        </div>
        @else
            {{ 'asu' }}
        @endif
        
        <button type="submit" class="btn btn-primary mt-2">add story</button>
    </form>
</div>

