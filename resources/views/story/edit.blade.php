<x-app-layout>
     <form action="{{ route('editstories') }}" method="POST">
        <input type="hidden" name="id" value="{{ $story->id }}">
        @csrf
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Quill Editor Default</h5>
                <textarea class="form-control required tinymce-editor" name="story" id="mytextarea">
                    {{ $story->stories }}
                </textarea>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">edit story</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
        
    </form>
</x-app-layout>